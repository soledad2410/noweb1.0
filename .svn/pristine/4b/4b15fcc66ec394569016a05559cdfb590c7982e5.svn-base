<?php

namespace Noweb\Cp;
use \Noweb\Cp\Paginator\Paginator;
use \Noweb\Cp\ProductProperties;

/**
 * Product properties
 */
class ProductPropertiesController extends BaseController {

	/**
	 * Index page
	 * @return void
	 */
	public function index() {
		$ppObj = new ProductProperties();
		$this->layout->meta = ['title' => 'Quản trị thuộc tính sản phẩm'];

		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 10;
		$offset = ($currentPage - 1) * $limit;

		$proProperties = ProductProperties::orderby('id', 'ASC')
			->skip($offset)
			->take($limit)
			->get();

		$total = ProductProperties::get()->count();
		$paginator = new Paginator($total, $limit, null, null, 5);

		$this->layout->content = \View::make($this->default_view)
			->with([
				'proProperties' => $proProperties,
				'paginator' => $paginator->generatePaginator(),
				'range' => $paginator->getResultRange(),

			]);
	}

	/**
	 * Create a new record
	 * @return json Message
	 */
	public function create() {
		$validator = \Validator::make(\Input::all(),
			[
				'name' => 'required|alpha_num|unique:product_properties,name,NULL,id',
				'title' => 'required|unique:product_properties,title,NULL,id',
			]);
		if ($validator->fails()) {
			return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
		}
		$pp = new ProductProperties();
		$pp->bindData(\Input::all());
		if ($pp->save()) {
			return \Response::json(['code' => 'success', 'pp' => $pp->toArray()]);
		} else {
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, thêm mới tag thất bại']);
		}
	}

	/**
	 * Edit record
	 * @return json Message
	 */
	public function edit() {
		if (\Input::has('id')) {
			$pp = ProductProperties::find(\Input::get('id'));
			if ($pp) {
				if (count(\Input::all()) > 2) {
					$validator = \Validator::make(\Input::all(),
						[
							'name' => 'required|unique:product_properties,name,' . $pp->name . ',name',
							'title' => 'required|unique:product_properties,title,' . $pp->title . ',title',
						]);

					if ($validator->fails()) {
						return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
					}
				}

				$pp->bindData(\Input::all());

				if ($pp->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Sửa thông tin thành công']);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'có lỗi xảy ra, Cập nhật thông tin thất bại']);
				}
			}
		}
	}

	/**
	 * @return json data
	 */
	public function get() {
		if (($id = intval(\Input::get('id')))) {
			$pp = ProductProperties::find($id);
			return \Response::json($pp->toArray());
		}
	}

	/**
	 * @return mixed
	 */
	public function delete() {
		$id = intval(\Input::get('id'));
		if ($id) {
			$pp = ProductProperties::find($id);
			if ($pp->delete()) {
				return \Response::json(['code' => 'success', 'msg' => 'Xóa thông tin thành công']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thông tin thất bại']);
			}
		}
	}
}