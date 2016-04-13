<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 13/12/2014
 * Time: 9:46 SA
 */

namespace Noweb\Frontend\Paginator;

class Paginator {

	protected $total;

	protected $perPage;

	protected $baseUrl;

	protected $params;

	protected $pageVisible;

	public function __construct($totalRecord, $perPage, $baseUrl = null, $params = null, $pageVisible = null) {
		$this->total = $totalRecord;
		$this->perPage = $perPage;

		if (!$baseUrl) {
			$urlArr = explode('.', $_SERVER['REQUEST_URI']);
			$this->suffix = end($urlArr);
			$this->baseUrl = strtok(prev($urlArr), '_');

			$currentPage = explode('_', $urlArr[0]);
			$currentPage = intval(end($currentPage));
			$this->currentPage = ($currentPage > 1) ? $currentPage : 1;
		} else {
			$this->baseUrl = $baseUrl;
		}

		if (!$params || !is_array($params)) {
			$this->params = \Input::get();
		} else {
			$this->params = $params;
		}
		$this->pageVisible = $pageVisible;
	}

	public function getTotalPage() {
		$page = 1;
		if (intval($this->perPage) > 0) {
			$page = ceil($this->total / $this->perPage);
		}
		$page = $page > 0 ? $page : 1;
		return $page;
	}

	public function getPageUrl($page) {
		$params = $this->params;
		$pattern = '';
		foreach ($params as $key => $value) {
			$pattern .= $key . "=" . $value . "&";
		}
		$pattern = rtrim($pattern, '&');
		return $this->baseUrl . '_' . $page . '.' . $this->suffix . $pattern;
	}

	public function generatePaginator() {
		if ($this->getTotalPage() <= 1) {
			return;
		}
		$str = '<ul>';
		$str .= ($this->currentPage != 1) ? '<li><a class="prev" href="' . ($this->currentPage > 1 ? $this->getPageUrl($this->currentPage - 1) : '') . '">&laquo;</a></li>' : '';

		if (!$this->pageVisible || $this->pageVisible > $this->getTotalPage()) {
			for ($i = 1; $i <= $this->getTotalPage(); $i++) {
				$str .= '<li><a class="' . ($this->currentPage == $i ? 'current' : '') . '" href="' . $this->getPageUrl($i) . '">' . $i . '</a></li>';
			}
		} else {

			$pageVisible = $this->getTotalPage() > $this->pageVisible ? $this->pageVisible : $this->getTotalPage();
			$pageFrom = $this->currentPage - floor($pageVisible / 2);

			$pageFrom = $pageFrom <= 1 ? 1 : $pageFrom;
			$pageTo = $pageFrom + $pageVisible;
			$pageTo = $pageTo >= $this->getTotalPage() ? $this->getTotalPage() : $pageTo;
			if ($pageTo > $pageFrom) {
				for ($i = $pageFrom; $i < $pageTo; $i++) {
					$str .= '<li><a class="' . ($this->currentPage == $i ? 'current' : '') . '" href="' . $this->getPageUrl($i) . '">' . $i . '</a></li>';
				}
			}
		}
		$str .= ($this->currentPage != $this->getTotalPage()) ? '<li><a href="' . ($this->currentPage + 1 <= $this->getTotalPage() ? $this->getPageUrl($this->currentPage + 1) : '') . '">&raquo;</a></li>' : '';
		$str .= '</ul>';
		return $str;
	}
	public function generateAjaxPaginator($datasources) {
		if ($this->getTotalPage() <= 1) {
			return;
		}
		$str = '<ul class="ajax-paginator" data-source="' . $datasources . '"><li class="prev ' . ($this->currentPage == 1 ? 'disabled' : '') . '"><a href="javascript:;" data-value="' . ($this->currentPage > 1 ? $this->currentPage - 1 : '') . '">&laquo;</a></li>';

		if (!$this->pageVisible || $this->pageVisible > $this->getTotalPage()) {
			for ($i = 1; $i <= $this->getTotalPage(); $i++) {
				$str .= '<li><a ' . ($i == 1 ? 'class="current"' : '') . ' href="javascript:;" data-value="' . $i . '">' . $i . '</a></li>';
			}
		} else {

			$pageVisible = $this->getTotalPage() > $this->pageVisible ? $this->pageVisible : $this->getTotalPage();
			$pageFrom = $this->currentPage - floor($pageVisible / 2);

			$pageFrom = $pageFrom <= 1 ? 1 : $pageFrom;
			$pageTo = $pageFrom + $pageVisible;
			$pageTo = $pageTo >= $this->getTotalPage() ? $this->getTotalPage() : $pageTo;
			if ($pageTo > $pageFrom) {
				for ($i = $pageFrom; $i < $pageTo; $i++) {
					$str .= '<li><a class="' . ($this->currentPage == $i ? 'current' : '') . '" href="javascript:;" data-value="' . $i . '">' . $i . '</a></li>';
				}
			}
		}
		$str .= '<li><a class="next ' . ($this->currentPage == $this->getTotalPage() ? 'disabled' : '') . '" href="javascript:void(0)" data-value="' . ($this->currentPage + 1 <= $this->getTotalPage() ? $this->currentPage + 1 : '') . '">&raquo;</a></li>
            </ul>';
		return $str;
	}

	public function getResultRange() {
		$from = ($this->currentPage - 1) * $this->perPage;
		$to = $this->currentPage * $this->perPage > $this->total ? $this->total : $this->currentPage * $this->perPage;
		return ['from' => $from, 'to' => $to, 'totalPage' => $this->getTotalPage(), 'totalRecord' => $this->total];
	}

}