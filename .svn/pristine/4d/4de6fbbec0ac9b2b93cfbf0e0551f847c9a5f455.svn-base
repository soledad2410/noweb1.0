<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 12/12/2001
 * Time: 2:02 CH
 */

namespace Noweb\Cp;
use \Illuminate\Database\Eloquent\Model;

class Contact extends Model {

	protected $table = 'contacts';

	public function deleteContact($ids) {
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