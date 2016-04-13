<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 28/02/2015
 * Time: 11:40 SA
 */

namespace Noweb\Cp;

use \Noweb\Cp\InventoryCatalogue;
use \Noweb\Cp\InventoryImportProduct;
use \Noweb\Cp\InventoryProduct;
use \Noweb\Cp\Paginator\Paginator;

class InventoryController extends BaseController {

	public function index() {
		$_SESSION['ck']['inventoryUpload'] = true;
		$this->layout->meta = ['title' => 'Danh sách hàng hóa kho'];
		$inventoryCatalogues = InventoryCatalogue::all();
		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 20;
		$offset = ($currentPage - 1) * $limit;
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'created_at';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'DESC';
		$products = InventoryProduct::orderBy($sortBy, $sort)->skip($offset)->take($limit)->get();
		$total = InventoryProduct::all()->count();
		$paginator = new Paginator($total, $limit, null, null, 5);
		$this->layout->content = \View::make($this->default_view)
			->with([
				'catalogues' => $inventoryCatalogues,
				'brands' => Brand::all(),
				'products' => $products,
				'paginator' => $paginator->generatePaginator(),
			]);
	}
	public function product() {
		if (!\Input::has('id')) {
			/** Create new product */
			$validator = \Validator::make(\Input::all(),
				[
					'name' => 'required|unique:inventory_product',
					'code' => 'required|unique:inventory_product',
				]);
			if ($validator->fails()) {
				return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
			}
			$product = new InventoryProduct();
			$product->bindData(\Input::all());
			$urlService = new \App\Service\URLService($product);
			$product->created_by = \Auth::user()->getAuthIdentifier();
			if (\Input::get('img')) {
				$product->img = str_replace($urlService->getInventoryUploadPath(), '', \Input::get('img'));
			}
			if ($product->save()) {
				return \Response::json(['code' => 'success', 'msg' => 'Thêm mới thông tin thành công']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Thêm mới thông tin thất bại']);
			}
		} else {

			$product = InventoryProduct::find(\Input::get('id'));
			if ($product) {
				$validator = \Validator::make(\Input::all(),
					[
						'name' => 'required|unique:inventory_product,name,' . $product->name . ',name',
						'code' => 'required|unique:inventory_product,name,' . $product->code . ',code',
					]);
				if ($validator->fails()) {
					return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
				}
				$product->bindData(\Input::all());
				$urlService = new \App\Service\URLService($product);
				if (\Input::get('img')) {
					$product->logo = str_replace($urlService->getInventoryUploadPath(), '', \Input::get('img'));
				}
				$product->updated_by = \Auth::user()->getAuthIdentifier();
				if ($product->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin thành công']);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
				}
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Thông tin không tồn tại hoặc đã bị xóa']);
			}
		}
	}

	public function catalogue() {
		$validator = \Validator::make(\Input::all(),
			[
				'name' => 'required|unique:inventory_catalogue',
			]);
		if ($validator->fails()) {
			return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
		}
		$catalogue = new InventoryCatalogue();
		$catalogue->bindData(\Input::all());
		if ($catalogue->save()) {
			return \Response::json(['code' => 'success', 'msg' => 'Thêm mới danh mục thành công']);
		} else {
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, thêm mới danh mục thất bại']);
		}
	}

	public function import() {
		/** Import new catalogue */
		if (\Input::has('product_id')) {
			$inventory = new InventoryImportCatalogue();
			$inventory->bindData(\Input::all());
			$inventory->import_date = getDatetime(\Input::get('import_date', 'H:i d-M-Y'));
			$inventory->created_by = \Auth::user()->getAuthIdentifier();
			if ($inventory->save()) {
				$import_id = $inventory->id;
				if (\Input::has('quantity')) {
					$qtt = \Input::get('quantity');
					$pIds = \Input::get('product_id');
					$prices = \Input::get('import_price');
					$damageds = \Input::get('damaged');
					$pImport = [];
					for ($i = 0; $i < count(\Input::get('quantity')); $i++) {
						$pImport[] = [
							'import_id' => $import_id,
							'quantity' => $qtt[$i],
							'import_price' => $prices[$i],
							'damaged' => $damageds[$i],
							'product_id' => $pIds[$i],
						];
					}
					$inventoryImport = new InventoryImportProduct();
					if ($inventoryImport::insert($pImport)) {
						return ['code' => 'success', 'msg' => 'Nhập kho sản phẩm thành công'];
					}
				}
			}
		}

		$_SESSION['ck']['inventoryUpload'] = true;
		$this->layout->meta = ['title' => 'Nhập kho sản phẩm'];
		$inventoryCatalogues = InventoryCatalogue::all();
		$this->layout->content = \View::make($this->default_view)
			->with([
				'catalogues' => $inventoryCatalogues,
				'brands' => Brand::all(),
			]);

	}

	public function editCatalogue() {
		if (\Input::has('id')) {
			$catalogue = InventoryCatalogue::find(\Input::get('id'));
			if ($catalogue) {
				$validator = \Validator::make(\Input::all(),
					[
						'name' => 'required|unique:inventory_catalogue,name,' . $catalogue->name . ',name',

					]);
				if ($validator->fails()) {
					return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
				}
				$catalogue->bindData(\Input::all());
				if ($catalogue->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Cập nhật danh mục thành công']);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật danh mục thất bại']);
				}
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Danh mục không tồn tại hoặc đã bị xóa']);
			}
		}
	}

	public function deleteCatalogue() {
		if (\Input::has('id')) {
			/** @var  $cat InventoryCatalogue */
			$cat = InventoryCatalogue::find(\Input::get('id'));
			if (!$cat) {
				return \Response::json(['code' => 'error', 'msg' => 'Danh mục không tồn tại hoặc đã bị xóa']);
			}
			if ($cat->delete()) {
				return \Response::json(['code' => 'success', 'msg' => 'Xóa danh mục thành công']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Danh mục không tồn tại hoặc đã bị xóa']);

		}
	}

	public function updateProduct() {

	}

	public function getProduct() {

		if (\Input::has('phrase')) {

			$phrase = trim(\Input::get('phrase'));
			if ($phrase) {
				$rs = InventoryProduct::where('name', 'like', '%' . $phrase . '%')->orWhere('code', 'like', '%' . $phrase . '%')->get();
				return \Response::json($rs->toArray());
			}
			return [];
		}
		return [];
	}

}