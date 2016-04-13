<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 5/13/2015
 * Time: 2:09 PM
 */

namespace Noweb\Frontend;
use \Noweb\Frontend\Category;
use \Noweb\Frontend\News;
use \Noweb\Frontend\Paginator\Paginator;
use \Noweb\Frontend\Url\Url;

class NewsController extends BaseController {

	public function index() {

	}

	public function cate($slug, $page = 1) {

		$limit = 3;
		$slug = strtok($slug, '_');
		$currentPage = intval($page) > 0 ? intval($page) : 1;
		$offset = ($currentPage - 1) * $limit;

		$newsObj = new News();
		$cateObj = new Category();

		$cate = Category::where('slug', $slug)->where('status', 1)->first();

		$urlObj = new Url();
		$breadcrumbs = $urlObj->generate_breadcrumb($cate->id);

		if (isset($cate->id)) {
			$news = $newsObj->get(null, null, $cate->id, null, $limit, $offset);
			$total = count($newsObj->get(null, null, $cate->id));
		} else {
			\App::abort(404);
		}

		$paginator = new Paginator($total, $limit, null, null, 5);

		$this->extra_data = ['title' => $cate->name, 'breadcrumbs' => $breadcrumbs];
		$this->setLayout();
		$this->setView();
		$this->layout->content = \View::make($this->view)->with(
			[
				'news' => $news,
				'paginator' => $paginator->generatePaginator(),
				'range' => $paginator->getResultRange(),
				'url' => $urlObj,
			]
		);
	}

	public function details($slug, $id) {

		$newsObj = new News();

		$news = $newsObj->get('news.*, categories.id AS cate_id, categories.name AS cate_name', $id);
		if ($news) {
			$news = $news[0];
		} else {
			\App::abort(404);
		}

		$urlObj = new Url();
		$breadcrumbs = $urlObj->generate_breadcrumb($news->cate_id);

		$relatedNewsID = explode('|', rtrim($news->related_news, '|'));
		$relatedNews = $newsObj->get('news.id, news.name, news.slug, news.published_time', null, null, [['news.id', '!=', $id], ['news.id', $relatedNewsID]]);

		$tagsNewsID = explode('|', rtrim($news->tags, '|'));
		$newsByTags = array();
		foreach ($tagsNewsID as $tagID) {
			$result = $newsObj->get('news.id, news.name, news.slug, news.published_time', null, null, [['news.id', '!=', $id], ['tags', 'LIKE', '%' . $tagID . '%']]);
			$newsByTags = array_merge($newsByTags, $result);
		}
		$relatedNews = array_merge($newsByTags, $relatedNews);
		$relatedNews = array_unique($relatedNews, SORT_REGULAR);

		// return \DB::getQueryLog();

		$this->extra_data = ['title' => $news->name . $news->cate_name, 'breadcrumbs' => $breadcrumbs];
		$this->setLayout();
		$this->setView();
		$this->layout->content = \View::make($this->view)->with(
			[
				'news' => $news,
				'relatedNews' => $relatedNews,
				'url' => $urlObj,
			]
		);
	}
}