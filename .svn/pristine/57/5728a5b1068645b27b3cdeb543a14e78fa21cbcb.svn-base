<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 5/8/2015
 * Time: 10:38 AM
 */

namespace Noweb\Cp;
use \App\Service\URLService;

class Product extends BaseModel {
	protected $table = 'product';

	/*  Api process */
	public static function api($action) {

		switch ($action) {
			case 'count':
				$news_num = \DB::table('product')->count();
				return $news_num;
				break;

			case 'insert':
				if (!\Input::has('title')) {
					Api::error('WTF?');
					return false;
				}
				$result = 'ok insert ok';

				return $result;
				break;

			default:
				# code...
				break;
		}
	}

	public function getThumbnail() {
		$urlService = new URLService($this);
		return $urlService->getThumbnailUrl();
	}

	public function getViewLink() {

	}

	/**
	 * @param array $cIds
	 * @use Update product category
	 */
	public function updateCategoryIds(array $cIds) {
		$cateInsert = [];
		foreach ($cIds as $cate) {
			$cateInsert[] = ['product_id' => $this->id, 'category_id' => $cate];
		}
		\DB::table('product_category')->where('product_id', '=', $this->id)->delete();
		\DB::table('product_category')->insert($cateInsert);
	}

	public function deleteProduct($ids) {
		/** Delete all category */
		if (is_array($ids)) {
			\DB::table($this->table)
				->whereIn('id', $ids)
				->delete();
			\DB::table($this->table)
				->whereIn('id', $ids)
				->delete();
			return true;
		} else {
			\DB::table($this->table)
				->where('id', '=', $ids)
				->delete();
			$this->delete();
			return true;
		}
		return false;
	}

	/**
	 * Delete product category by product_id
	 * @param  integer $product_id Product ID
	 * @return bool
	 */
	public function deleteProductCategory($product_id) {

		if (is_array($product_id)) {
			\DB::table('product_category')
				->whereIn('product_id', $product_id)
				->delete();
			\DB::table('product_category')
				->whereIn('product_id', $product_id)
				->delete();
			return true;
		} else {
			\DB::table('product_category')
				->where('product_id', '=', $product_id)
				->delete();
			$this->delete();
			return true;
		}
		return false;
	}
}