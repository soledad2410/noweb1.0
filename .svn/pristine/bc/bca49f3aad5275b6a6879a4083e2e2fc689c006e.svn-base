<?php

namespace Noweb\Frontend\Url;
use \App\Service\URLService;
use \Noweb\Frontend\Category;

class Url {
	function generate_breadcrumb($cate_id) {
		$cateObj = new Category();
		$string = '';
		$cate_array = explode('|', $cateObj->get_parent_recursion($cate_id));
		$cate_array = array_reverse($cate_array);
		$cate_array = array_unique($cate_array);
		// return $cate_array;
		$rs[] = ['title' => 'Trang chủ', 'link' => '/'];
		foreach ($cate_array as $cate) {
			if ($cate != 0) {
				$cate = $cateObj->get('categories.id, categories.name, categories.slug, categories.type', $cate);
				if ($cate) {
					$cate = $cate[0];
					if ($cate->type == 'news') {
						$rs[] = array('title' => $cate->name, 'link' => $this->get_news_cate_url($cate));
					} elseif ($cate->type == 'product') {
						$rs[] = array('title' => $cate->name, 'link' => $this->get_product_cate_url($cate));
					}

				}
			}
		}
		return $rs;
	}

	public function get_menu_url($item) {
		if (isset($item['name']) && isset($item['slug']) && isset($item['type'])) {
			if ($item['type'] == 'custom_page' || $item['type'] == 'contact') {
				$url = \URL::to('/') . '/' . $item['slug'] . '.html';
			} else {
				$url = \URL::to('/') . '/' . $item['type'] . '/cate/' . $item['slug'] . '.html';
			}

			return $url;
		}
	}

	public function get_news_url($item) {
		if (isset($item->name) && isset($item->id) && isset($item->slug)) {
			$url = \URL::to('/') . '/news/' . $item->slug . '_' . $item->id . '.html';
			return $url;
		}
	}

	public function get_news_cate_url($item) {
		if (isset($item->name) && isset($item->id) && isset($item->slug)) {
			$url = \URL::to('/') . '/news/cate/' . $item->slug . '.html';
			return $url;
		}
	}

	public function get_product_url($item) {
		if (isset($item->name) && isset($item->id) && isset($item->slug)) {
			$url = \URL::to('/') . '/product/' . $item->slug . '_' . $item->id . '.html';
			return $url;
		}
	}

	public function get_product_cate_url($item) {
		if (isset($item->name) && isset($item->id) && isset($item->slug)) {
			$url = \URL::to('/') . '/product/cate/' . $item->slug . '.html';
			return $url;
		}
	}

	public function get_thumbnail($item) {
		$urlService = new URLService($item);
		return \Url::to('/') . '/' . $urlService->getUploadPath() . $item->thumbnail;
	}
}