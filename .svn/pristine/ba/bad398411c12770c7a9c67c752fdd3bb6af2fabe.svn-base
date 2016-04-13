<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 11/21/14
 * Time: 10:16 AM
 */
namespace Noweb\Frontend;
Class IndexController extends BaseController {

	public function index() {
		$this->extra_data = ['title' => 'Trang chủ'];
		$this->setLayout('default');
		$this->setView();
		$this->layout->content = \View::make($this->view);
	}
}