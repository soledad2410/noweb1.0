<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 5/7/2015
 * Time: 6:01 PM
 */

namespace Noweb\Cp;
use \App\Service\URLService;
use \Noweb\Cp\DomainService;
use \Noweb\Cp\Paginator\Paginator;
use \Noweb\Cp\Product;
use \Noweb\Cp\ProductProperties;
use \Noweb\Cp\ProductReview;

class ProductController extends BaseController {

	public function index() {
		$this->layout->meta = ['title' => 'Trang quản lý sản phẩm'];
		$domain = new DomainService();
		$_SESSION['ck']['private'] = false;
		$_SESSION['ck']['inventoryUpload'] = true;
		$domainId = $domain->getDomain()->id;
		$langId = $this->current_language->id;
		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 5;
		$offset = ($currentPage - 1) * $limit;
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'product.id';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'ASC';
		if (\Input::has('cat')) {
			$products = Product::leftJoin('product_category', 'product_category.product_id', '=', 'product.id')
				->where('product.domain_id', $domain->getDomain()->id)
				->where('product.language_id', $this->current_language->id)
				->where('product_category.category_id', '=', \Input::get('cat'))
				->where(function ($query) {
					if (\Input::has('status') && \Input::get('status') != 'all') {
						$query->where('product.status', '=', \Input::get('status'));
					}
				})
				->where(function ($query) {
					if (\Input::has('type') && \Input::get('type') != 'all') {
						$query->where('product.type', '=', \Input::get('type'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::get('from')) > 0) {
						$query->where('product.created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::get('to')) > 0) {
						$query->where('product.created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::has('keyword')) > 0) {
						$query->where('product.name', 'LIKE', '%' . \Input::get('keyword') . '%');
					}
				})
				->orderby($sortBy, $sort)
				->skip($offset)
				->take($limit)->get(
				[
					'product.*',
					'product_category.category_id',
				]
			);
			$total = Product::leftJoin('product_category', 'product_category.product_id', '=', 'product.id')
				->where('product.domain_id', $domain->getDomain()->id)
				->where('product.language_id', $this->current_language->id)
				->where('product_category.category_id', '=', \Input::get('cat'))
				->where(function ($query) {
					if (\Input::has('status') && \Input::get('status') != 'all') {
						$query->where('product.status', '=', \Input::get('status'));
					}
				})
				->where(function ($query) {
					if (\Input::has('type') && \Input::get('type') != 'all') {
						$query->where('product.type', '=', \Input::get('type'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::get('from')) > 0) {
						$query->where('product.created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::get('to')) > 0) {
						$query->where('product.created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::has('keyword')) > 0) {
						$query->where('product.name', 'LIKE', '%' . \Input::get('keyword') . '%');
					}
				})
				->get()->count();
		} else {
			$products = Product::where('domain_id', $domain->getDomain()->id)
				->where('language_id', $this->current_language->id)
				->where(function ($query) {
					if (\Input::has('status') && \Input::get('status') != 'all') {
						$query->where('status', '=', \Input::get('status'));
					}
				})
				->where(function ($query) {
					if (\Input::has('type') && \Input::get('type') != 'all') {
						$query->where('type', '=', \Input::get('type'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::get('from')) > 0) {
						$query->where('created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::get('to')) > 0) {
						$query->where('created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::has('keyword')) > 0) {
						$query->where('name', 'LIKE', '%' . \Input::get('keyword') . '%');
					}
				})
				->orderby($sortBy, $sort)
				->skip($offset)
				->take($limit)->get();
			$total = Product::where('domain_id', $domain->getDomain()->id)
				->where('language_id', $this->current_language->id)
				->where(function ($query) {
					if (\Input::has('status') && \Input::get('status') != 'all') {
						$query->where('status', '=', \Input::get('status'));
					}
				})
				->where(function ($query) {
					if (\Input::has('type') && \Input::get('type') != 'all') {
						$query->where('type', '=', \Input::get('type'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::get('from')) > 0) {
						$query->where('created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::get('to')) > 0) {
						$query->where('created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
					}
				})
				->where(function ($query) {
					if (strlen(\Input::has('keyword')) > 0) {
						$query->where('name', 'LIKE', '%' . \Input::get('keyword') . '%');
					}
				})
				->get()->count();
		}
		// return $products;
		$paginator = new Paginator($total, $limit, null, null, 5);
		$categories = Category::leftJoin('categories AS cate_parent', 'categories.parent_id', '=', 'cate_parent.id')
			->where('categories.domain_id', '=', $domainId)
			->where('categories.language_id', '=', $langId)
			->where('categories.type', '=', 'product')
			->get(['categories.id', 'categories.name', 'cate_parent.id AS parent_id', 'cate_parent.name AS parent_name', 'categories.type']);
		// return $categories;
		$cateObj = new Category();
		$catesArray = $categories->toArray();
		$trees = $cateObj->buildHierarchicalCategories($catesArray, 0);
		$this->layout->content = \View::make($this->default_view)
			->with([
				'products' => $products,
				'paginator' => $paginator->generatePaginator(),
				'range' => $paginator->getResultRange(),
				'brands' => Brand::all(),
				'selectTree' => $cateObj->generateSelectBoxTrees($trees, 0),
				'radioTreeView' => $cateObj->generateCheckboxTrees($trees, 'name="category_id[]"', [], ['product']),
				'catalogues' => $categories,
			]);
	}

	public function create() {

		$domain = new DomainService();

		// Get product properties
		$pp = ProductProperties::where('status', '=', 1)->get();

		$_SESSION['ck']['private'] = false;
		$_SESSION['ck']['inventoryUpload'] = false;
		$domainId = $domain->getDomain()->id;
		$langId = $this->current_language->id;

		/** add new product */
		if (\Input::has('name')) {
			$validator = \Validator::make(\Input::all(),
				[
					'name' => 'required|unique:product,name,NULL,id,domain_id,' . $domainId,
					'code' => 'required|unique:product,code,NULL,id,domain_id,' . $domainId,
				]);

			$product = new Product();
			$urlService = new URLService($product);
			$product->bindData(\Input::all());

			foreach ($pp as $value) {
				$product->$value['product_var'] = \Input::get($value['name']);
			}

			$product->price = currency2Number(\Input::get('price'));
			$product->language_id = $langId;
			$product->domain_id = $domainId;

			if (\Input::get('image')) {
				$thumbnail = str_replace($urlService->getUploadPath(), '', \Input::get('image'));
				$product->thumbnail = $thumbnail;

			}
			// return \Input::get('category_id');
			if ($product->save()) {
				$product_id = $product->id;
				// Update categories
				if (is_array(\Input::get('category_id'))) {
					foreach (\Input::get('category_id') as $category_id) {
						$productCate = new ProductCategory();
						$productCate->product_id = $product_id;
						$productCate->category_id = $category_id;
						$productCate->save();
					}
				}
				return ['code' => 'success', 'msg' => 'Đăng sản phẩm thành công', 'id' => $product_id];
			}

		}
		$categories = Category::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $langId)
			// ->where('type', '=', 'product')
			->get(['id', 'parent_id', 'name', 'type']);
		$cateObj = new Category();
		$catesArray = $categories->toArray();
		$trees = $cateObj->buildHierarchicalCategories($catesArray, 0);

		$this->layout->meta = ['title' => 'Trang quản lý sản phẩm - Thêm mới sản phẩm'];
		$this->layout->content = \View::make($this->default_view)
			->with([
				'brands' => Brand::all(),
				'catalogues' => Category::where('domain_id', $domainId)->where('language_id', $langId)->where('type', 'product')->get(),
				'radioTreeView' => $cateObj->generateCheckboxTrees($trees, 'name="category_id[]"', [], ['product']),
				'ppArray' => $pp,
			]);
	}
	public function get() {
		if (\Input::has('id')) {
			$_SESSION['ck']['private'] = false;
			$_SESSION['ck']['inventoryUpload'] = false;
			$id = \Input::get('id');
			$product = Product::find($id);
			$product->image = $product->getThumbnail();
			if ($product) {
				return \Response::json($product->toArray());
			}
		}
	}
	public function edit($id = null) {
		/** post update */
		$user_id = \Auth::user()->getAuthIdentifier();
		$domainService = new DomainService();
		$domainId = $domainService->getDomain()->id;
		$_SESSION['ck']['private'] = false;
		$_SESSION['ck']['inventoryUpload'] = false;

		// Get product properties
		$pp = ProductProperties::where('status', '=', 1)->get();

		/** Edit product details page */
		if (intval($id) > 0) {
			$product = Product::find($id);
			// if (empty($product)) {
			//  return \Redirect::route('cp-404');
			// }
			$_SESSION['ck']['private'] = false;

			$categories = Category::where('domain_id', '=', $domainId)
				->where('language_id', '=', $this->current_language->id)
				->where('type', '=', 'product')
				->get(['id', 'parent_id', 'name', 'type']);
			$cateObj = new Category();
			$catesArray = $categories->toArray();

			$catesID = ProductCategory::where('product_id', $id)->get(['category_id']);
			$catesIDArray = [];
			foreach ($catesID as $cat_id) {
				$catesIDArray[] = $cat_id->category_id;
			}
			$trees = $cateObj->buildHierarchicalCategories($catesArray, 0);

			$this->layout->meta = ['title' => 'Sửa thông tin sản phẩm'];
			$this->layout->content = \View::make($this->default_view)
				->with([
					'product' => $product,
					'brands' => Brand::all(),
					'catalogues' => Category::where('domain_id', $domainId)->where('language_id', $this->current_language->id)->where('type', 'product')->get(),
					'radioTreeView' => $cateObj->generateCheckboxTrees($trees, 'name="category_id[]"', $catesIDArray, ['product']),
					'ppArray' => $pp,
				]);
		}

		/** Edit submit */
		if (\Input::has('id')) {
			$pid = \Input::get('id');
			$product = Product::find($pid);
			if ($product) {
				if (count(\Input::all()) > 2) {
					if (\Input::has('id')) {
						if (\Input::has('name') && \Input::has('name')) {
							/** Validator */
							$validator = \Validator::make(\Input::all(),
								[
									'name' => 'required|unique:product,name,' . $product->name . ',name,domain_id,' . $domainId,
									'slug' => 'required|unique:product,slug,' . $product->slug . ',slug,domain_id,' . $domainId,
								]);
							if ($validator->fails()) {
								return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
							}
						}
						$urlService = new \App\Service\URLService($product);
						$product->bindData(\Input::all());

						/** Update status */
						$product->show_hot = \Input::has('show_hot') ? 1 : 0;
						$product->comment_allowed = \Input::has('comment_allowed') ? 1 : 0;

						/** Update thumbnail */
						if (\Input::get('image')) {
							$image = str_replace($urlService->getUploadPath(), '', \Input::get('image'));
							$product->thumbnail = $image;
						}
						/** Update categories */
						$cates = [];
						if (\Input::has('category_id')) {
							$cates = \Input::get('category_id');
						}
						$product->updateCategoryIds($cates);

						if ($product->save()) {
							return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin sản phẩm thành công', 'redirect' => '/cp/product']);
						}
					}
				} else {
					$status = \Input::get('status');
					$product->status = $status;
					$product->updated_at = date('Y-m-d H:i:s');
					$product->updated_by = $user_id;
					if ($product->save()) {
						return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin thành công']);
					} else {
						return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
					};
					return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
				}
			}
		}
	}

	/** Delete */
	public function delete() {
		$id = \Input::get('id');
		if (!is_array($id)) {
			$product = Product::find($id);
			if ($product) {
				if ($product->deleteProduct($id)) {
					$product->deleteProductCategory($id);
					return \Response::json(['code' => 'success']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa sản phẩm thất bại']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Sản phẩm không tồn tại hoặc đã bị xóa']);
		} else {
			$product = new Product();
			if ($product->deleteProduct($id)) {
				$product->deleteProductCategory($id);
				return \Response::json(['code' => 'success']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa sản phẩm thất bại']);
		}
	}
	/** Review */
	public function review() {
		$this->layout->meta = ['title' => 'Trang quản lý đánh giá sản phẩm'];

		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 7;
		$offset = ($currentPage - 1) * $limit;
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'product_reviews.created_at';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'DESC';
		// Get Product review
		$reviews = ProductReview::join('product', 'product_reviews.product_id', '=', 'product.id')
			->groupby('product_reviews.product_id')
			->orderby($sortBy, $sort)
			->skip($offset)
			->take($limit)->get(
			[
				'product.name AS product_name',
				'product_reviews.*',
				\DB::raw('avg(product_reviews.review_rating) avg_rating'),
			]
		);
		// Get total records
		$total = ProductReview::join('product', 'product_reviews.product_id', '=', 'product.id')
			->groupby('product_reviews.product_id')
			->get()->count();
		$paginator = new Paginator($total, $limit, null, null, 5);
		// Call view
		$this->layout->content = \View::make($this->default_view)
			->with([
				'reviews' => $reviews,
				'range' => $paginator->getResultRange(),
				'paginator' => $paginator->generatePaginator(),
			]);
	}
	public function getReview($product_id = null) {
		// Get Product review
		$reviews = ProductReview::join('product', 'product_reviews.product_id', '=', 'product.id')
			->where('product_reviews.product_id', '=', $product_id)
			->orderby('product_reviews.created_at', 'DESC')
			->get(
				[
					'product.name AS product_name',
					'product_reviews.*',
					'product_reviews.review_rating AS avg_rating',
				]
			);
		if ($reviews) {
			return \Response::json($reviews->toArray());
		}
	}
	public function saveReview($id = null) {
		$status = \Input::get('status');
		if (\DB::table('product_reviews')->where('id', '=', $id)->update(['review_status' => $status])) {
			return \Response::json(['code' => 'success', 'msg' => 'Đổi trạng thái thành công']);
		} else {
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, không thể thay đổi trạng thái']);
		};
	}
	/** Delete review */
	public function deleteReview() {
		$id = \Input::get('id');
		if (!is_array($id)) {
			$reviews = ProductReview::find($id);
			if ($reviews) {
				if ($reviews->deleteReview($id)) {
					return \Response::json(['code' => 'success']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa bình chọn thất bại']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Bình chọn không tồn tại hoặc đã bị xóa']);
		} else {
			$review = new ProductReview();
			if ($review->deleteReview($id)) {
				return \Response::json(['code' => 'success']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa bình chọn thất bại']);
		}
	}
}