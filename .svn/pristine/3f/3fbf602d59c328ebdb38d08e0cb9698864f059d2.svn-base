<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 07/01/2015
 * Time: 1:41 CH
 */

namespace Noweb\Cp;
use \App\Service\URLService;

class Gallery extends BaseModel {

	protected $table = 'galleries';

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

	public function deleteGallery($ids) {
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

	public function getLatestCateOrder() {
		$domainService = new \Noweb\Cp\DomainService();
		$domainId = $domainService->getDomain()->id;
		$gallery = $this->where('domain_id', '=', $domainId)->orderby('order_num', 'desc')->first();
		return empty($gallery) ? null : $gallery;
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
	public function buildHierarchicalGalleries(array $elements, $parentId = 0) {
		$branch = array();
		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
				$children = $this->buildHierarchicalGalleries($elements, $element['id']);
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
		foreach ($trees as $gallery) {
			$childIds = array_merge($childIds, [$gallery['id']]);
			if (isset($gallery['children'])) {
				$childIds = array_merge($childIds, $this->getAllChildIds($gallery['children']));
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
		foreach ($trees as $gallery) {
			$i = '<i class="icon-archive"></i> Lưu nháp';
			switch ($gallery['status']) {
				case '1':
					$i = '<i class="icon-ok"></i> Đã đăng';
					break;
				case '2':
					$i = '<i class="icon-circle-arrow-down"></i> Đã hạ';
				default:
					break;

			}

			$content .= ' <tr rel="' . $gallery['id'] . '" parent="' . $gallery['parent_id'] . '" class="tree-tr';
			$content .= ($gallery['parent_id'] == 0) ? ' parent' : ' child';
			$content .= '">';
			$content .= '<td class="center"><input type="checkbox" name="id[]" value="' . $gallery['id'] . '"></td>';
			$content .= '<td>';
			$content .= '<span class="tree-separator"></span>';
			$content .= '<a href="/cp/gallery/album/' . $gallery['id'] . '">' . $gallery['name'] . '</a></td>';
			$content .= '<td class="p-team"><img src="';
			$content .= !empty($gallery['image']) ? $this->getThumbnailUrl() . $gallery['image'] : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';
			$content .= '"></td>';
			$content .= '<td >' . formatDatetimeVi($gallery['created_at']) . '</td>';
			$content .= '<td><div class="btn-group"> <a data-toggle="dropdown" href="javascript:;">' . $i;
			$content .= '</a>';
			$content .= '<ul class="dropdown-menu btn-sm">';
			$content .= ($gallery['status'] == 1) ? '<li><a onclick="change_status(' . $gallery['id'] . ', 2);" data-rel="' . $gallery['id'] . '" href="javascript:;"><i class="icon-circle-arrow-down"></i> Hạ </a></li>' : '<li><a onclick="change_status(' . $gallery['id'] . ', 1);" data-rel="' . $gallery['id'] . '" href="javascript:;"><i class="icon-ok"></i> Đăng </a></li>';
			$content .= '<li class="divider"></li>';
			$content .= '<li><a class="edit" data-rel="' . $gallery['id'] . '" href="javascript:;"><i class="icon-edit"></i> Sửa </a></li>';
			$content .= '<li><a class="delete" data-rel="' . $gallery['id'] . '" href="javascript:;"><i class="icon-remove"></i> Xóa</a></li>';
			$content .= '</ul>';
			$content .= '</div>';
			$content .= '</td>';
			$content .= '<td class="sorter text-center"><div class="icon-move"></div></td>';
			$content .= '</tr>';
			if (isset($gallery['children']) && !empty($gallery['children'])) {
				$content .= $this->generateTableTrees($gallery['children']);
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
		foreach ($trees as $gallery) {
			$content .= '<option value="' . $gallery['id'] . '" parent="' . $gallery['parent_id'] . '">' . $gallery['name'] . '</option>';
			if (isset($gallery['children']) && !empty($gallery['children'])) {
				$content .= $this->generateSelectBoxTrees($gallery['children']);
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
		foreach ($trees as $gallery) {
			$content .= '<li><input ' . ($modules ? (!in_array($gallery['type'], $modules) ? 'disabled="true"' : '') : '') . ' type="checkbox" ' . $plusInfo . ' value="' . $gallery['id'] . '" ' . ($dataVals ? (in_array($gallery['id'], $dataVals) ? 'checked="true"' : '') : '') . '> ' . $gallery['name'];
			if (isset($gallery['children']) && is_array($gallery['children'])) {
				$content .= $this->generateCheckboxTrees($gallery['children'], $plusInfo, $dataVals, $modules);
			}
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
		foreach ($trees as $gallery) {
			$content .= '<li><input ' . ($modules ? (!in_array($gallery['type'], $modules) ? 'disabled="true"' : '') : '') . ' type="radio" ' . $plusInfo . ' value="' . $gallery['id'] . '" ' . ($dataVals ? (in_array($gallery['id'], $dataVals) ? 'checked="true"' : '') : '') . '> ' . $gallery['name'];
			if (isset($gallery['children']) && is_array($gallery['children'])) {
				$content .= $this->generateRadioTrees($gallery['children'], $plusInfo, $dataVals, $modules);
			}
			$content .= '</li>';
		}

		$content .= '</ul>';

		return $content;
	}

}