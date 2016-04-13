<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 11/03/2015
 * Time: 2:41 CH
 */

namespace Noweb\Cp;
use \Noweb\Cp\Brand;

class BrandController extends BaseController {

	public function create() {
		if (!\Input::has('id')) {
			/** Create new brand */
			$validator = \Validator::make(\Input::all(),
				[
					'name' => 'required|unique:brand',
				]);
			if ($validator->fails()) {
				return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
			}
			$brand = new Brand();
			$brand->bindData(\Input::all());
			$urlService = new \App\Service\URLService($brand);
			if (\Input::get('logo')) {
				$brand->logo = str_replace($urlService->getInventoryUploadPath(), '', \Input::get('logo'));
			}
			if ($brand->save()) {
				return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thương hiệu thành công']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thương hiệu thất bại']);
			}
		} else {

			$brand = Brand::find(\Input::get('id'));
			if ($brand) {
				$validator = \Validator::make(\Input::all(),
					[
						'name' => 'required|unique:brand,name,' . $brand->name . ',name',

					]);
				if ($validator->fails()) {
					return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
				}
				$brand->bindData(\Input::all());
				$urlService = new \App\Service\URLService($brand);
				if (\Input::get('logo')) {
					$brand->logo = str_replace($urlService->getInventoryUploadPath(), '', \Input::get('logo'));
				}
				if ($brand->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin thành công']);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
				}
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Thông tin không tồn tại hoặc đã bị xóa']);
			}
		}

	}

	public function get() {
		if (\Input::has('id')) {
			$brand = Brand::find(\Input::get('id'));
			if ($brand) {
				$brand->logo = $brand->getLogo();
				return \Response::json($brand->toArray());
			}
		}
	}

	public function delete() {
		if (\Input::has('id')) {
			/** @var  $cat InventoryCatalogue */
			$brand = Brand::find(\Input::get('id'));
			if (!$brand) {
				return \Response::json(['code' => 'error', 'msg' => 'Thông tin không tồn tại hoặc đã bị xóa']);
			}
			if ($brand->delete()) {
				return \Response::json(['code' => 'success', 'msg' => 'Xóa thông tin thành công']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Thông tin tồn tại hoặc đã bị xóa']);

		}
	}
}