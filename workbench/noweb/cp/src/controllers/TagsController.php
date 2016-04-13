<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 11/12/2014
 * Time: 9:55 SA
 */

namespace Noweb\Cp;
use \Noweb\Cp\DomainService;
use \Noweb\Cp\Paginator\Paginator;
use \Noweb\Cp\Tag;

class TagsController extends BaseController {

	public function index() {
		$this->layout->meta = ['title' => 'Quản trị danh sách tags website', 'header' => 'Danh sách tags'];
		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 10;
		$offset = ($currentPage - 1) * $limit;
		$domain = new DomainService();

		$total = Tag::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $this->current_language->id)
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
			->count();
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'created_at';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'DESC';
		$tags = Tag::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $this->current_language->id)
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
			->take($limit)
			->get();
		$paginator = new Paginator($total, $limit, null, null, 5);

		$this->layout->content = \View::make($this->default_view)
			->with([
				'paginator' => $paginator->generatePaginator(),
				'tags' => $tags,
				'range' => $paginator->getResultRange(),

			]);
	}

	public function create() {
		$domainService = new \Noweb\Cp\DomainService();
		$domainId = $domainService->getDomain()->id;
		$validator = \Validator::make(\Input::all(),
			[
				'name' => 'required|unique:tags,name,NULL,id,domain_id,' . $domainId,
				'slug' => 'required|unique:tags,slug,NULL,id,domain_id,' . $domainId,
			]);
		if ($validator->fails()) {
			return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
		}
		$tag = new Tag();
		$tag->bindData(\Input::all());
		$tag->domain_id = $domainId;
		$tag->language_id = $this->current_language->id;
		$tag->created_by = \Auth::user()->getAuthIdentifier();
		if ($tag->save()) {
			return \Response::json(['code' => 'success', 'tag' => $tag->toArray()]);
		} else {
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, thêm mới tag thất bại']);
		}
	}

	public function edit() {
		if (\Input::has('id')) {
			$tag = Tag::find(\Input::get('id'));
			if ($tag) {
				$domainService = new \Noweb\Cp\DomainService();
				$domainId = $domainService->getDomain()->id;
				$validator = \Validator::make(\Input::all(),
					[
						'name' => 'required|unique:tags,name,' . $tag->name . ',name,domain_id,' . $domainId,
						'slug' => 'required|unique:tags,slug,' . $tag->slug . ',slug,domain_id,' . $domainId,
					]);
				$tag->bindData(\Input::all());
				if ($validator->fails()) {
					return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
				} else {

					if ($tag->save()) {
						return \Response::json(['code' => 'success', 'msg' => 'Sửa thông tin thành công']);
					} else {
						return \Response::json(['code' => 'error', 'msg' => 'có lỗi xảy ra, Cập nhật thông tin thất bại']);
					}
				}
			}
		}
	}

	/**
	 * @return json data
	 */
	public function get() {
		if (($id = intval(\Input::get('id')))) {
			$tag = Tag::find($id);
			return \Response::json($tag->toArray());
		}
	}

	/**
	 * @return mixed
	 */
	public function delete() {
		$id = intval(\Input::get('id'));
		if ($id) {
			$tag = Tag::find($id);
			if ($tag->delete()) {
				return \Response::json(['code' => 'success', 'msg' => 'Xóa thông tin thành công']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thông tin thất bại']);
			}
		}
	}
}