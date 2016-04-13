<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 08/01/2015
 * Time: 11:46 SA
 */

namespace Noweb\Cp;

class CachingController extends BaseController {

	public function push($key) {
		$cachingService = new \Noweb\Cp\CachingService();
		if (\Input::get()) {
			$data = json_encode(\Input::all());
			$cachingService->push($key, $data);
			return \Response::json(['code' => 'ok']);
		}

	}

	public function get($key) {
		$cachingService = new \Noweb\Cp\CachingService();
		return $cachingService->get($key);
	}

	public function clear($key) {

	}
}