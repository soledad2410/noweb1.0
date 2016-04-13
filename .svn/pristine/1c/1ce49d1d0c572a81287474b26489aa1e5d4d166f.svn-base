<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 07/01/2015
 * Time: 1:41 CH
 */

namespace Noweb\Cp;
use \App\Service\URLService;

class Media extends BaseModel {

	protected $table = 'media';
	public $timestamps = false;

	protected $modules = [
		['name' => 'news', 'title' => 'Trang tin tức', 'active' => 1],
		['name' => 'product', 'title' => 'Trang sản phẩm', 'active' => 1],
		['name' => 'contact', 'title' => 'Trang liên hệ', 'active' => 1],
		['name' => 'album', 'title' => 'Trang album ảnh', 'active' => 1],
		['name' => 'custom_page', 'title' => 'Trang nội dung riêng', 'active' => 1],
		['name' => 'link', 'title' => 'Link liên kết', 'active' => 1],

	];
	protected $childs;

	public function getThumbnailUrl() {
		$urlService = new URLService($this);
		return $urlService->getThumbnailUrl();
	}

	public function deleteMedia($ids) {
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