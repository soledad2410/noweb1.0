<?php

namespace Noweb\Frontend;

class Product extends BaseModel {

	protected $table = 'product';

	public function get($cols = null, $id = null, $cate = null, $where = null, $limit = null, $offset = null, $order = null) {

		$column_select = isset($cols) ? array_map('trim', explode(',', $cols)) : [$this->table . ".*", \DB::raw("GROUP_CONCAT(categories.id SEPARATOR ', ') AS cate_id"), \DB::raw("GROUP_CONCAT(categories.name SEPARATOR ', ') AS cate_name")];
		$products = \DB::table($this->table)
			->select($column_select)
			->leftJoin('product_category', 'product_category.product_id', '=', 'product.id')
			->leftJoin('categories', 'product_category.category_id', '=', 'categories.id')
			->where('product.status', '=', 1)
			->where('categories.status', '=', 1)
			->where(function ($query) use ($id) {
				if (intval($id) > 0) {
					$query->where('product.id', '=', $id);
				}
			})
			->where(function ($query) use ($cate) {
				if (!is_null($cate)) {
					$query->where('product_category.category_id', '=', $cate);
				}
			})
			->where(function ($query) use ($where) {
				for ($i = 0; $i < count($where); $i++) {
					if (!is_array($where[$i][1]) && isset($where[$i][2])) {
						$query->where($where[$i][0], $where[$i][1], $where[$i][2]);
					}
					if (is_array($where[$i][1])) {
						$query->whereIn($where[$i][0], $where[$i][1]);
					}
				}
			})
			->where(function ($query) use ($order) {
				if (!is_null($order)) {
					foreach ($order as $key => $value) {
						$query->orderby($key, $value);
					}
				}
			})
			->skip(intval($offset) ? intval($offset) : 0)
			->take(intval($limit) ? intval($limit) : 20)
			->groupby('product.id')
			->get();
		return $products;
	}

}