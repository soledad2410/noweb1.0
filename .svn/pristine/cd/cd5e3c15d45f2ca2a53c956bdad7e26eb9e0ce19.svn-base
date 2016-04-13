<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 5/12/2015
 * Time: 11:49 AM
 */

namespace Noweb\Cp;

class ProductReview extends BaseModel {

	protected $table = 'product_reviews';

	public function deleteReview($ids) {
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
}