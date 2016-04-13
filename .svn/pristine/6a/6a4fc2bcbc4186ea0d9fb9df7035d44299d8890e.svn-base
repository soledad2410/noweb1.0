<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 13/12/2014
 * Time: 5:36 CH
 */

namespace App\Service;

class URLService {

	protected $obj;

	public function __construct($obj) {
		$this->obj = $obj;
	}

	public function getAvatarUrl() {
		if ($this->obj instanceof \Noweb\Cp\User) {
			return '/' . \Config::get('cp::cp.userfile_dir') . '/' . $this->obj->username . '/images/' . $this->obj->avatar;
		}

	}

	public function getThumbnailUrl() {
		if ($this->obj instanceof \Noweb\Cp\News || $this->obj instanceof \Noweb\Cp\Product) {
			return $this->getUploadPath() . $this->obj->thumbnail;
		}
		if ($this->obj instanceof \Noweb\Cp\Gallery) {
			return $this->getUploadPath() . $this->obj->image;
		}
		if ($this->obj instanceof \Noweb\Cp\Media) {
			return $this->getUploadPath() . $this->obj->image;
		}
		if ($this->obj instanceof \Noweb\Cp\Brand) {
			return $this->getInventoryUploadPath() . $this->obj->logo;
		}
		if ($this->obj instanceof \Noweb\Cp\InventoryProduct) {
			return $this->getInventoryUploadPath() . $this->obj->img;
		}
		if ($this->obj instanceof \Noweb\Cp\Product) {
			return $this->getInventoryUploadPath() . $this->obj->image;
		}
	}
	public function getViewLink() {
		/** View link of news,product,album,category here */

	}

	public function getUploadPath() {
		return \Config::get('cp::cp.upload_dir') . '/' . $_SERVER['SERVER_NAME'];
	}

	public function getInventoryUploadPath() {
		return \Config::get('cp::cp.inventory_dir');
	}

}