<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 14/01/2015
 * Time: 2:20 CH
 */

namespace Noweb\Cp;
use \Noweb\Cp\Category;
use \Noweb\Cp\DomainService;

class CategoryController extends BaseController {

	public function index($type = false) {
		$this->layout->meta = ['title' => 'Trang quản lý chuyên mục'];

		$domain = new DomainService();
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'order_num';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'ASC';
		// Get categories
		$categories = Category::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $this->current_language->id)
			->where(function ($query) {
				if (\Input::has('type') && \Input::get('type') != 'all') {
					$query->where('type', '=', \Input::get('type'));
				}
			})
			->orderby($sortBy, $sort)->get();
		// return \DB::getQueryLog();
		// Get categories trees
		$cateObj = new Category();
		$catesArray = $categories->toArray();
		$trees = $cateObj->buildHierarchicalCategories($catesArray, 0);
		$_SESSION['ck']['private'] = false;
		// Call view
		$this->layout->content = \View::make($this->default_view)
			->with([
				'tableTree' => $cateObj->generateTableTrees($trees, 0),
				'selectTree' => $cateObj->generateSelectBoxTrees($trees, 0),
				'selectModule' => $cateObj->generateModuleSelectbox(),
			]);
	}

	public function create() {
		$domainService = new DomainService();
		$domainId = $domainService->getDomain()->id;
		$validator = \Validator::make(\Input::all(),
			[
				'name' => 'required|unique:categories,name,NULL,id,domain_id,' . $domainId,
				'slug' => 'required|unique:categories,slug,NULL,id,domain_id,' . $domainId,
			]);
		if ($validator->fails()) {
			return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
		}

		$cate = new Category();
		$latestCate = $cate->getLatestCateOrder();
		$cate->bindData(\Input::all());
		$cate->domain_id = $domainId;
		$cate->language_id = $this->current_language->id;
		$cate->created_by = \Auth::user()->getAuthIdentifier();
		$cate->order_num = $latestCate ? $latestCate->order_num + 1 : 1;
		if ($cate->save()) {
			return \Response::json(['code' => 'success', 'msg' => 'Thêm mới chuyên mục tin tức thành công ']);
		}
	}

	public function edit($id = null) {
		$this->layout->meta = ['title' => 'Trang sửa chuyên mục'];

		$domainService = new DomainService();
		$domain_id = $domainService->getDomain()->id;
		$language_id = $this->current_language->id;
		$user_id = \Auth::user()->getAuthIdentifier();
		if (intval($id) > 0) {
			$category = Category::where('language_id', '=', $language_id)
				->where('domain_id', '=', $domain_id)
				->where('id', '=', $id)->first();

			$categories = Category::where('domain_id', '=', $domain_id)
				->where('language_id', '=', $language_id)->get();
			$cateObj = new Category();
			$catesArray = $categories->toArray();
			$trees = $cateObj->buildHierarchicalCategories($catesArray, 0);
			$_SESSION['ck']['private'] = false;

			$this->layout->content = \View::make($this->default_view)
				->with([
					'tableTree' => $cateObj->generateTableTrees($trees, 0),
					'selectTree' => $cateObj->generateSelectBoxTrees($trees, 0),
					'selectModule' => $cateObj->generateModuleSelectbox(),
					'category' => $category,
				]);
		}

		if (\Input::has('id')) {
			if (count(\Input::all()) > 2) {
				$validator = \Validator::make(\Input::all(),
					[
						'name' => 'required|unique:categories,name,' . $category->name . ',name,domain_id,' . $domain_id,
						'slug' => 'required|unique:categories,slug,' . $category->slug . ',slug,domain_id,' . $domain_id,
					]);
				/** Validate parent id */
				$parent_id = \Input::get('parent_id');
				$categories = Category::where('domain_id', '=', $domain_id)
					->where('language_id', '=', $language_id)
					->where('type', '=', 'news')
					->get(['id', 'parent_id']);
				$trees = $category->buildHierarchicalCategories($categories->toArray(), $category->id);
				$childIds = $category->getAllChildIds($trees);
				$childIds[] = $category->id;
				if (in_array(\Input::get('parent_id'), $childIds)) {
					return \Response::json(['code' => 'error', 'msg' => 'Danh mục cha thay đổi không được nằm trong danh sách danh mục con của chính nó']);
				}
			}
			$category->bindData(\Input::all());
			$category->update_by = $user_id;
			if (!\Input::has('status') && !\Input::has('show_menu')) {
				$category->status = 2;
			}
			if (isset($validator) && $validator->fails()) {
				return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
			} else {
				if ($category->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Sửa thông tin thành công']);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'có lỗi xảy ra, Cập nhật thông tin thất bại']);
				}
			}
		}
	}

	public function delete() {
		$id = \Input::get('id');
		if (!is_array($id)) {
			$id = \Input::get('id');
			$cate = Category::find($id);
			if (!$cate) {
				return \Response::json(['code' => 'error', 'msg' => 'Chuyên mục này không tồn tại hoặc đã bị xóa']);
			}
			$domainService = new DomainService();
			$domain_id = $domainService->getDomain()->id;
			$language_id = $this->current_language->id;
			$count = Category::where('language_id', '=', $language_id)
				->where('domain_id', '=', $domain_id)
				->where('parent_id', '=', $id)->count();
			if ($count > 0) {
				return \Response::json(['code' => 'error', 'msg' => 'Chuyên mục này đang chứa danh mục con, không thể xóa']);
			} else {
				if ($cate->deleteCates()) {
					return \Response::json(['code' => 'success']);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thông tin thất bại']);
				}
			}
		} else {
			$category = new Category();
			if ($category->deleteCates($id)) {
				return \Response::json(['code' => 'success']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thông tin thất bại']);
			};
		}
	}

	/**
	 * Save categories order
	 * @return void
	 */
	public function saveOrder() {
		$positions = \Input::get('position');
		$domainService = new DomainService();
		$domainId = $domainService->getDomain()->id;
		foreach ($positions as $id => $position) {
			$cate = Category::find($id);
			\DB::table('categories')
				->where('domain_id', '=', $domainId)
				->where('id', '=', $id);
			$cate->order_num = $position;
			$cate->save();
		}
		return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thành công!']);
		// return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thất bại!']);
	}

	/**
	 * @param null $id
	 * @return mixed
	 */
	public function get($id = null) {
		$domainService = new DomainService();
		$domain_id = $domainService->getDomain()->id;
		$language_id = $this->current_language->id;
		if (intval($id) > 0) {
			$category = Category::where('language_id', '=', $language_id)
				->where('domain_id', '=', $domain_id)
				->where('id', '=', $id)->first();
			if ($category) {
				return $category->toArray();
			}
		}
	}
}