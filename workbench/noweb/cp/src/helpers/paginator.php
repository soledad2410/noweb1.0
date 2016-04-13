<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 13/12/2014
 * Time: 9:46 SA
 */

namespace Noweb\Cp\Paginator;

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
			$this->baseUrl = strtok($_SERVER['REQUEST_URI'], '?');
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
		$params['page'] = $page;
		$pattern = '';
		foreach ($params as $key => $value) {
			$pattern .= $key . "=" . $value . "&";
		}
		return $this->baseUrl . '?' . $pattern;
	}

	public function getCurrentPage() {
		$currentPage = intval(\Input::get('page')) > 0 ? intval(\Input::get('page')) : 1;
		return $currentPage;
	}

	public function generatePaginator() {
		if ($this->getTotalPage() <= 1) {
			return;
		}
		$str = '<ul><li class="prev ' . ($this->getCurrentPage() == 1 ? 'disabled' : '') . '"><a href="' . ($this->getCurrentPage() > 1 ? $this->getPageUrl($this->getCurrentPage() - 1) : '') . '">← Prev</a></li>';

		if (!$this->pageVisible || $this->pageVisible > $this->getTotalPage()) {
			for ($i = 1; $i <= $this->getTotalPage(); $i++) {
				$str .= '<li class="' . ($this->getCurrentPage() == $i ? 'active' : '') . '"><a href="' . $this->getPageUrl($i) . '">' . $i . '</a></li>';
			}
		} else {

			$pageVisible = $this->getTotalPage() > $this->pageVisible ? $this->pageVisible : $this->getTotalPage();
			$pageFrom = $this->getCurrentPage() - floor($pageVisible / 2);

			$pageFrom = $pageFrom <= 1 ? 1 : $pageFrom;
			$pageTo = $pageFrom + $pageVisible;
			$pageTo = $pageTo >= $this->getTotalPage() ? $this->getTotalPage() : $pageTo;
			if ($pageTo > $pageFrom) {
				for ($i = $pageFrom; $i < $pageTo; $i++) {
					$str .= '<li class="' . ($this->getCurrentPage() == $i ? 'active' : '') . '"><a href="' . $this->getPageUrl($i) . '">' . $i . '</a></li>';
				}
			}
		}
		$str .= '<li class="' . ($this->getCurrentPage() == $this->getTotalPage() ? 'disabled' : '') . '"><a href="' . ($this->getCurrentPage() + 1 <= $this->getTotalPage() ? $this->getPageUrl($this->getCurrentPage() + 1) : '') . '">Next → </a></li>
            </ul>';
		return $str;
	}
	public function generateAjaxPaginator($datasources) {
		if ($this->getTotalPage() <= 1) {
			return;
		}
		$str = '<ul class="ajax-paginator" data-source="' . $datasources . '"><li class="prev ' . ($this->getCurrentPage() == 1 ? 'disabled' : '') . '"><a href="javascript:;" data-value="' . ($this->getCurrentPage() > 1 ? $this->getCurrentPage() - 1 : '') . '">← Prev</a></li>';

		if (!$this->pageVisible || $this->pageVisible > $this->getTotalPage()) {
			for ($i = 1; $i <= $this->getTotalPage(); $i++) {
				$str .= '<li ' . ($i == 1 ? 'class="active"' : '') . ' ><a href="javascript:;" data-value="' . $i . '">' . $i . '</a></li>';
			}
		} else {

			$pageVisible = $this->getTotalPage() > $this->pageVisible ? $this->pageVisible : $this->getTotalPage();
			$pageFrom = $this->getCurrentPage() - floor($pageVisible / 2);

			$pageFrom = $pageFrom <= 1 ? 1 : $pageFrom;
			$pageTo = $pageFrom + $pageVisible;
			$pageTo = $pageTo >= $this->getTotalPage() ? $this->getTotalPage() : $pageTo;
			if ($pageTo > $pageFrom) {
				for ($i = $pageFrom; $i < $pageTo; $i++) {
					$str .= '<li class="' . ($this->getCurrentPage() == $i ? 'active' : '') . '"><a href="javascript:;" data-value="' . $i . '">' . $i . '</a></li>';
				}
			}
		}
		$str .= '<li class="next ' . ($this->getCurrentPage() == $this->getTotalPage() ? 'disabled' : '') . '"><a href="javascript:void(0)" data-value="' . ($this->getCurrentPage() + 1 <= $this->getTotalPage() ? $this->getCurrentPage() + 1 : '') . '">Next → </a></li>
            </ul>';
		return $str;
	}

	public function getResultRange() {
		$from = ($this->getCurrentPage() - 1) * $this->perPage;
		$to = $this->getCurrentPage() * $this->perPage > $this->total ? $this->total : $this->getCurrentPage() * $this->perPage;
		return ['from' => $from, 'to' => $to, 'totalPage' => $this->getTotalPage(), 'totalRecord' => $this->total];
	}

}