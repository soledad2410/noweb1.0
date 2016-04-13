<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 07/01/2015
 * Time: 6:41 CH
 */

namespace Noweb\Cp;

class NewsComment extends BaseModel {

	protected $table = 'news_comments';

	public function deleteComment($ids) {
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

	/**
	 * @param array $elements
	 * @param int $parentId
	 * @return array
	 */
	public function buildHierarchicalComments(array $elements, $parentId = 0) {
		$branch = array();
		foreach ($elements as $element) {
			if ($element['parent_id'] == $parentId) {
				$children = $this->buildHierarchicalComments($elements, $element['id']);
				if ($children) {
					$element['children'] = $children;
				}
				$branch[] = $element;
			}
		}
		return $branch;
	}

	/**
	 * @param array $trees
	 * @return string
	 */
	public function generateTableTrees(array $trees) {
		$content = '';
		foreach ($trees as $item) {
			$content .= '<tr rel="' . $item['id'] . '">';
			$content .= '<td class="center"><input type="checkbox" name="id[]" value="' . $item['id'] . '"></td>';
			$content .= '<td>' . $item['title'] . '</td>';
			$content .= '<td>';
			$content .= ($item['number_child'] > 0) ? '<a href="/cp/news/comments?reply_id=' . $item['id'] . '">' . $item['number_child'] . '</a>' : 0;
			$content .= '</td>';
			$content .= '<td>' . $item['fullname'] . '</td>';
			$content .= '<td class="news_name"><a href="/cp/news/comments?news_id=' . $item['news_id'] . '">' . $item['news_name'] . '</a></td>';
			$content .= '<td>' . formatDatetimeVi($item['created_at']) . '</td>';
			$content .= '<td>';
			$content .= '<div class="btn-group">';
			$content .= '<a data-toggle="dropdown" href="javascript:;">';
			if ($item['status'] == 0) {
				$content .= '<i class="icon-remove"></i> Chưa duyệt';
			}
			if ($item['status'] == 1) {
				$content .= '<i class="icon-ok"></i> Đã xem';
			}
			if ($item['status'] == 2) {
				$content .= '<i class="icon-ok"></i> Đã trả lời';
			}
			if ($item['status'] == 3) {
				$content .= '<i class="icon-ok"></i> Đã duyệt';
			}

			$content .= '</a>';
			$content .= '<ul class="dropdown-menu btn-sm choose-edit">';
			$content .= '<li><a data-rel="' . $item['id'] . '" onclick="change_status(' . $item['id'] . ', 3)" href="javascript:;"><i class="icon-circle-arrow-up"></i> Duyệt</a></li>';
			$content .= '<li><a data-rel="' . $item['id'] . '" onclick="change_status(' . $item['id'] . ', 0)" data-value="0" href="javascript:;"><i class="icon-circle-arrow-down"></i> Bỏ duyệt</a></li>';
			$content .= '<li class="divider"></li>';
			$content .= '<li><a class="reply" data-value="' . $item['id'] . '" href="javascript:;"><i class="icon-reply"></i> Trả lời</a></li>';
			$content .= '<li><a class="delete" data-value="' . $item['id'] . '" href="javascript:;"><i class="icon-remove"></i> Xóa</a></li>';
			$content .= '</ul></div></td></tr>';

		}
		return $content;
	}
}