<?php

namespace Noweb\Frontend;

class Widget extends BaseModel {

	protected $table = 'widget';
	public $timestamps = false;

	public function get($cols = null, $id = null, $where = null) {

		$column_select = isset($cols) ? array_map('trim', explode(',', $cols)) : [$this->table . ".*"];
		$result = \DB::table($this->table)
			->select($column_select)
			->where('status', '=', 1)
			->where(function ($query) use ($id) {
				if (intval($id) > 0) {
					$query->where('id', '=', $id);
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
			});
		if (is_null($id)) {
			return $result->first();
		} else {
			return $result->get();
		}
	}

}