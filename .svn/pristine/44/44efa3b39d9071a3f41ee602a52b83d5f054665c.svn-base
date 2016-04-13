<?php

namespace Noweb\Frontend;
use \Noweb\Frontend\Url\Url;

class Category extends BaseModel {

	protected $table = 'categories';

	public function get($cols = null, $id = null, $parent = null, $where = null, $order = ['categories.order_num', 'ASC']) {

		$column_select = isset($cols) ? array_map('trim', explode(',', $cols)) : [$this->table . ".*", 'parent.id AS parent_id', 'parent.name AS parent_name'];
		$categories = \DB::table($this->table)
			->select($column_select)
			->leftJoin('categories AS parent', 'categories.parent_id', '=', 'parent.id')
			->where('categories.status', '=', 1)
			->where(function ($query) use ($id) {
				if (intval($id) > 0) {
					$query->where('categories.id', '=', $id);
				}
			})
			->where(function ($query) use ($parent) {
				if (!is_null($parent)) {
					$query->where('categories.parent_id', '=', $parent);
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
			->orderby($order[0], $order[1])
			->get();
		return $categories;
	}

	public function get_parent_recursion($cate_id) {
		$result = $cate_id . '|';
		$parent = $this->get('categories.parent_id', $cate_id);
		if ($parent) {
			$parent = $parent[0]->parent_id;
			if ($parent != '0') {
				$result .= $this->get_parent_recursion($parent);
			}
		}
		$result = rtrim($result, '|');
		return $result;
	}

	public function get_menu_secursion($parent_id = 0) {
		$menu = [];
		$parents = $this->get(null, null, $parent_id, [['categories.status', '=', 1], ['categories.show_menu', '=', 1]]);
		if ($parents) {
			foreach ($parents as $key => $parent) {
				$menu[$key] = (array) $parent;
				$children = $this->get_menu_secursion($parent->id);
				if ($children) {
					$menu[$key]['children'] = $children;
				}
			}
		}
		return $menu;
	}

	public function build_menu_html($menus = null, $children = false) {
		$menus = $this->get_menu_secursion();
		$urlObj = new Url();
		if ((!$children)) {
			$str = '<div class="nav-bar">' . PHP_EOL . '<div class="container">' . PHP_EOL . '<div class="row">' . PHP_EOL . '<ul class="main-nav">' . PHP_EOL . '<li';
			if ($_SERVER['REQUEST_URI'] == '/') {
				$str .= ' class="active"';
			}

			$str .= '><a href="/">Trang chủ</a></li>' . PHP_EOL;
		} else {
			$str = '<ul>' . PHP_EOL;
		}

		foreach ($menus as $menu) {
			$str .= '<li';
			$str .= (strpos($_SERVER['REQUEST_URI'], $menu['slug'])) ? ' class="active"' : '';
			$str .= '><a href="' . $urlObj->get_menu_url($menu) . '">' . $menu['name'] . '</a>';
			if (isset($menu['children'])) {
				// $str .= $this->build_menu_html($menu['children'], true);
			}
			$str .= '</li>' . PHP_EOL;
		}
		$str .= (!$children) ? PHP_EOL . '</ul>' . PHP_EOL . '</div>' . PHP_EOL . '</div>' . PHP_EOL . '</div>' : '</ul>' . PHP_EOL;
		return $str;
	}

}