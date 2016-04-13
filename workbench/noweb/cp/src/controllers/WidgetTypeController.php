<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 17/12/2014
 * Time: 10:08 SA
 */

namespace Noweb\Cp;
use \Noweb\Cp\Paginator\Paginator;
use \Noweb\Cp\WidgetType;

class WidgetTypeController extends BaseController {

	public function index() {
		$this->layout->meta = ['title' => 'Quản trị loại khối'];

		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 10;
		$offset = ($currentPage - 1) * $limit;
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'id';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'DESC';

		$widgetType = WidgetType::orderby($sortBy, $sort)
			->skip($offset)
			->take($limit)
			->get();

		$total = WidgetType::get()->count();
		$paginator = new Paginator($total, $limit, null, null, 5);

		$this->layout->content = \View::make($this->default_view)
		     ->with([
			     'widgetType' => $widgetType,
			     'paginator' => $paginator->generatePaginator(),
			     'range' => $paginator->getResultRange(),

		     ]);
	}
	public function create() {
		// Process quest
		if (\Input::has('name')) {
			$widgetType = new WidgetType();
			$widgetType->bindData(\Input::all());

			// Convert config title
			$cfg_title = '';
			if (count(\Input::get('config_title')) > 0) {

				foreach (\Input::get('config_title') as $ct) {
					$cfg_title .= $ct . '|';
				}

			}
			$widgetType->config_title = rtrim($cfg_title, '|');
			// Convert config name
			$cfg_name = '';
			if (count(\Input::get('config_name')) > 0) {

				foreach (\Input::get('config_name') as $cn) {
					$cfg_name .= $cn . '|';
				}

			}
			$widgetType->config_name = rtrim($cfg_name, '|');
			// Convert field type
			$field_type = '';
			if (count(\Input::get('field_type')) > 0) {

				foreach (\Input::get('field_type') as $ft) {
					$field_type .= $ft . '|';
				}

			}
			$widgetType->field_type = rtrim($field_type, '|');
			// Convert field value
			$field_value = '';
			if (count(\Input::get('field_value')) > 0) {

				foreach (\Input::get('field_value') as $ft) {
					$field_value .= $ft . '|';
				}

			}
			$widgetType->field_value = rtrim($field_value, '|');
			if ($widgetType->save()) {
				$id = $widgetType->id;
				return ['code' => 'success', 'msg' => 'Thêm cấu hình thành công', 'id' => $id];
			} else {
				return ['code' => 'error', 'msg' => 'Có lỗi, không lưu được dữ liệu'];
			}
		}
		// Load view
		$this->layout->meta = ['title' => 'Trang quản lý loại khối - Thêm loại khối mới'];
		$this->layout->content = \View::make($this->default_view);
	}
	public function edit($id = null) {
		$widgetType = WidgetType::find($id);
		$widgetType['config_name'] = explode('|', $widgetType['config_name']);
		$widgetType['config_title'] = explode('|', $widgetType['config_title']);
		$widgetType['field_type'] = explode('|', $widgetType['field_type']);
		$widgetType['field_value'] = explode('|', $widgetType['field_value']);

		// Process quest
		if (\Input::has('name')) {
			$widgetType->bindData(\Input::all());

			// Convert config title
			$cfg_title = '';
			if (count(\Input::get('config_title')) > 0) {

				foreach (\Input::get('config_title') as $ct) {
					$cfg_title .= $ct . '|';
				}

			}
			$widgetType->config_title = rtrim($cfg_title, '|');
			// Convert config name
			$cfg_name = '';
			if (count(\Input::get('config_name')) > 0) {

				foreach (\Input::get('config_name') as $cn) {
					$cfg_name .= $cn . '|';
				}

			}
			$widgetType->config_name = rtrim($cfg_name, '|');
			// Convert field type
			$field_type = '';
			if (count(\Input::get('field_type')) > 0) {
				foreach (\Input::get('field_type') as $ft) {
					$field_type .= $ft . '|';
				}
			}
			$widgetType->field_type = rtrim($field_type, '|');
			// Convert field value
			$field_value = '';
			if (count(\Input::get('field_value')) > 0) {

				foreach (\Input::get('field_value') as $ft) {
					$field_value .= $ft . '|';
				}

			}
			$widgetType->field_value = rtrim($field_value, '|');
			if ($widgetType->save()) {
				$id = $widgetType->id;
				return ['code' => 'success', 'msg' => 'Sửa cấu hình loại khối thành công', 'id' => $id];
			} else {
				return ['code' => 'error', 'msg' => 'Có lỗi, không lưu được dữ liệu'];
			}
		}
		// Load view
		$this->layout->meta = ['title' => 'Trang quản lý loại khối - Sửa thuộc tính loại khối'];
		$this->layout->content = \View::make($this->default_view)->with(
			[
				'item' => $widgetType,
			]
		);
	}
	public function delete() {
		$id = intval(\Input::get('id'));
		if ($id) {
			$widgetType = WidgetType::find($id);
			if ($widgetType->delete()) {
				return \Response::json(['code' => 'success', 'msg' => 'Xóa thành công']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Không xóa được, mời thử lại']);
			}
		}
	}
}