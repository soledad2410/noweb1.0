<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 07/01/2015
 * Time: 1:41 CH
 */

namespace Noweb\Cp;

class Category extends BaseModel {

	protected $table = 'categories';

	protected $modules = [
		['name' => 'news', 'title' => 'Trang tin tức', 'active' => 1],
		['name' => 'product', 'title' => 'Trang sản phẩm', 'active' => 1],
		['name' => 'contact', 'title' => 'Trang liên hệ', 'active' => 1],
		['name' => 'album', 'title' => 'Trang album ảnh', 'active' => 1],
		['name' => 'custom_page', 'title' => 'Trang nội dung riêng', 'active' => 1],
		['name' => 'link', 'title' => 'Link liên kết', 'active' => 1],

	];
	protected $childs;

	public function deleteCates($ids = null) {
		/** Delete all category */
		if (!$ids && $this->id) {
			\DB::table($this->table)
				->where('id', '=', $this->id)
				->delete();
			$this->delete();
			return true;
		}
		if (is_array($ids)) {
			\DB::table($this->table)
				->whereIn('id', $ids)
				->delete();
			\DB::table($this->table)
				->whereIn('id', $ids)
				->delete();
			return true;
		}
	}

	public function getLatestCateOrder() {
		$domainService = new \Noweb\Cp\DomainService();
		$domainId = $domainService->getDomain()->id;
		$cate = $this->where('domain_id', '=', $domainId)->orderby('order_num', 'desc')->first();
		return empty($cate) ? null : $cate;
	}

	public function getModules() {
		return $this->modules;
	}

	public function addChild($obj) {
		$this->childs[] = $obj;
	}

	/**
	 * @return string
	 */
	public function generateModuleSelectbox() {
		$str = '';
		foreach ($this->getModules() as $item) {
			if ($item['active'] == 1) {
				$str .= '<option value="' . $item['name'] . '">' . $item['title'] . '</option>';
			}
		}
		return $str;
	}

	/**
	 * @param array $elements
	 * @param int $parentId
	 * @return array
	 */
	public function buildHierarchicalCategories(array $elements, $parentId = 0) {
		$branch = array();
		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
				$children = $this->buildHierarchicalCategories($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}
		return $branch;
	}

	/**
	 * @param $trees
	 * @return array
	 */
	public function getAllChildIds($trees) {
		$childIds = [];
		foreach ($trees as $cate) {
			$childIds = array_merge($childIds, [$cate['id']]);
			if (isset($cate['children'])) {
				$childIds = array_merge($childIds, $this->getAllChildIds($cate['children']));
			}
		}
		return $childIds;

	}

	/**
	 * @param $name
	 * @return array
	 */
	public function getModuleByName($name) {
		$module = [];
		foreach ($this->modules as $item) {
			if ($item['name'] == $name) {
				$module = $item;
			}
		}
		return $module;
	}

	/**
	 * @param array $trees
	 * @return string
	 */
	public function generateTableTrees(array $trees) {
		$content = '';
		foreach ($trees as $cate) {
			$i = '<i class="icon-archive"></i> Lưu nháp';
			switch ($cate['status']) {
				case '1':
					$i = '<i class="icon-ok"></i> Đã đăng';
					if ($cate['show_menu'] == 1) {
						$i .= ' (Show menu)';
					}
					break;
				case '2':
					$i = '<i class="icon-circle-arrow-down"></i> Đã hạ';
				default:
					break;

			}

			$content .= ' <tr rel="' . $cate['id'] . '" parent="' . $cate['parent_id'] . '" class="tree-tr';
			$content .= ($cate['parent_id'] == 0) ? ' parent' : ' child';
			$content .= '">';
			$content .= '<td class="center"><input type="checkbox" name="id[]" value="' . $cate['id'] . '"></td>';
			$content .= '<td><span class="tree-separator"></span> ' . $cate['name'] . '<strong>(' . $this->getModuleByName($cate['type'])['title'] . ')</strong></td>';
			$content .= '<td>' . $cate['slug'] . '</td>';
			$content .= '<td >' . formatDatetimeVi($cate['created_at']) . '</td>';
			$content .= '<td><div class="btn-group"> <a data-toggle="dropdown" href="javascript:;">' . $i;
			$content .= '</a>';
			$content .= '<ul class="dropdown-menu btn-sm">';
			$content .= ($cate['status'] == 1) ? '<li><a onclick="change_status(' . $cate['id'] . ', 2);" data-rel="' . $cate['id'] . '" href="javascript:;"><i class="icon-circle-arrow-down"></i> Hạ </a></li>' : '<li><a onclick="change_status(' . $cate['id'] . ', 1);" data-rel="' . $cate['id'] . '" href="javascript:;"><i class="icon-ok"></i> Đăng </a></li>';
			$content .= ($cate['show_menu'] == 1) ? '<li><a onclick="change_show_menu(' . $cate['id'] . ', 0);" data-rel="' . $cate['id'] . '" href="javascript:;"><i class="icon-circle-arrow-down"></i> Bỏ khỏi menu</a></li>' : '<li><a onclick="change_show_menu(' . $cate['id'] . ', 1);" data-rel="' . $cate['id'] . '" href="javascript:;"><i class="icon-ok"></i> Thêm vào menu</a></li>';
			$content .= '<li class="divider"></li>';
			$content .= '<li><a data-rel="' . $cate['id'] . '" href="/cp/category/edit/' . $cate['id'] . '"><i class="icon-edit"></i> Sửa </a></li>';
			$content .= '<li><a class="delete-cate" data-rel="' . $cate['id'] . '" href="javascript:;"><i class="icon-remove"></i> Xóa</a></li>';
			$content .= '</ul>';
			$content .= '</div>';
			$content .= '</td>';
			$content .= '<td class="sorter text-center"><div class="icon-move"></div></td>';
			$content .= '</tr>';
			if (isset($cate['children']) && !empty($cate['children'])) {
				$content .= $this->generateTableTrees($cate['children']);
			}

		}
		return $content;
	}

	/**
	 * @param array $trees
	 * @return string
	 */
	public function generateSelectBoxTrees(array $trees) {
		$content = '';
		foreach ($trees as $cate) {
			$content .= '<option type="' . $cate['type'] . '" value="' . $cate['id'] . '" parent="' . $cate['parent_id'] . '">' . $cate['name'] . '</option>';
			if (isset($cate['children']) && !empty($cate['children'])) {
				$content .= $this->generateSelectBoxTrees($cate['children']);
			}

		}
		return $content;
	}

	/**
	 * @param array $trees
	 * @param $plusInfo
	 * @param array $dataVals
	 * @param array $modules
	 * @return string
	 */
	public function generateCheckboxTrees(array $trees, $plusInfo, $dataVals = [], $modules = []) {
		$content = '<ul>';
		foreach ($trees as $cate) {
			$content .= '<li class="checkbox"><label><input ' . ($modules ? (!in_array($cate['type'], $modules) ? 'disabled="true"' : '') : '') . ' type="checkbox" ' . $plusInfo . ' value="' . $cate['id'] . '" ' . ($dataVals ? (in_array($cate['id'], $dataVals) ? 'checked="true"' : '') : '') . '> ' . $cate['name'];
			if (isset($cate['children']) && is_array($cate['children'])) {
				$content .= $this->generateCheckboxTrees($cate['children'], $plusInfo, $dataVals, $modules);
			}
			$content .= '</label></li>';
		}
		$content .= '</ul>';
		return $content;
	}

	/**
	 * @param array $trees
	 * @param string $plusInfo
	 * @param bool|int $dataVal
	 * @return string
	 */
	public function generateRadioTrees(array $trees, $plusInfo, $dataVals = false, $modules = []) {
		$content = '<ul>';
		foreach ($trees as $cate) {
			$content .= '<li><input ' . ($modules ? (!in_array($cate['type'], $modules) ? 'disabled="true"' : '') : '') . ' type="radio" ' . $plusInfo . ' value="' . $cate['id'] . '" ' . ($dataVals ? (in_array($cate['id'], $dataVals) ? 'checked="true"' : '') : '') . '> ' . $cate['name'];
			if (isset($cate['children']) && is_array($cate['children'])) {
				$content .= $this->generateRadioTrees($cate['children'], $plusInfo, $dataVals, $modules);
			}
			$content .= '</li>';
		}

		$content .= '</ul>';

		return $content;
	}

	/**
	 * [generateNestableTrees description]
	 * @param  array  $trees [description]
	 * @return string        [description]
	 */
	public function generateNestableTrees(array $trees) {
		$content = '<ol class="dd-list">';
		foreach ($trees as $cate) {
			$content .= '<li class="dd-item" data-id="' . $cate['id'] . '">';
			$content .= '<div class="dd-handle">' . $cate['name'] . '</div>';
			if (isset($cate['children']) && is_array($cate['children'])) {
				$content .= $this->generateNestableTrees($cate['children']);
			}
			$content .= '</li>';
		}
		$content .= '</ol>';
		return $content;
	}

	public function saveCateOrder($cateArray, $parent_id = 0) {
		foreach ($cateArray as $position => $cate) {
			if (is_numeric($cate['id'])) {
				$data = [
					'order_num' => $position,
					'parent_id' => $parent_id,
				];
				\DB::table($this->table)->where('id', '=', (int) $cate['id'])->update($data);
				if (isset($cate['children'])) {
					$this->saveCateOrder($cate['children'], (int) $cate['id']);
				}
			}
		}
		return true;
	}

}