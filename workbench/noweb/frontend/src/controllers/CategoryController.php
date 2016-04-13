<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 5/13/2015
 * Time: 2:09 PM
 */

namespace Noweb\Frontend;
use \Noweb\Frontend\Category;
use \Noweb\Frontend\Paginator\Paginator;
use \Noweb\Frontend\Product;
use \Noweb\Frontend\Url\Url;

class CategoryController extends BaseController {

	public function index($slug, $page = 1) {

		// Config
		$limit = 6;
		$total = 0;
		$slug = strtok($slug, '_');
		$currentPage = intval($page) > 0 ? intval($page) : 1;
		$offset = ($currentPage - 1) * $limit;

		// Generate paginator
		$paginator = new Paginator($total, $limit, null, null, 5);

		// Get category data by slug
		$cate_array = Category::where('status', '=', 1)->where('slug', '=', $slug)->first();

		// Show 404 page if category don't exists
		isset($cate_array->id) || \App::abort(404);

		// breadcrumbs
		$urlObj = new Url();
		$breadcrumbs = $urlObj->generate_breadcrumb($cate_array->id);

		$data = array(
			'url' => $urlObj,
			'paginator' => $paginator->generatePaginator(),
			'range' => $paginator->getResultRange(),
		);
		switch ($cate_array->type) {

			// Product category
			case 'product':

				$productObj = new Product();
				$products = $productObj->get(null, null, $cate_array->id, null, $limit, $offset);
				$total = count($productObj->get(null, null, $cate_array->id));

				$data = array_merge($data, array(
					'products' => $products,
				));
				$layout = ($cate_array->layout != 'default') ? $cate_array->layout : 'cate';
				$view = ($cate_array->template != 'default') ? $cate_array->layout : 'product_cate';

				break;

			// News category
			case 'news':

				$newsObj = new News();
				$news = $newsObj->get(null, null, $cate_array->id, null, $limit, $offset);
				$total = count($newsObj->get(null, null, $cate_array->id));

				$layout = ($cate_array->layout != 'default') ? $cate_array->layout : 'cate';
				$view = ($cate_array->template != 'default') ? $cate_array->template : 'news_cate';
				$data = array_merge($data, array(
					'news' => $news,
				));

				break;

			// Custom page
			case 'custom_page':

				$layout = $cate_array->layout;
				$view = ($cate_array->template != 'default') ? $cate_array->template : 'custom_page';
				$data = array_merge($data, array(
					'cate' => $cate_array->toArray(),
				));

				break;

			// Contact page
			case 'contact':

				$layout = $cate_array->layout;
				$view = ($cate_array->template != 'default') ? $cate_array->template : 'contact';
				$data = array_merge($data, array(
					'cate' => $cate_array->toArray(),
				));

				break;

			case 'album':
			case 'link':

			// Default category
			default:
				$layout = $cate_array->layout;
				$view = $cate_array->template;
				break;
		}
		$this->extra_data = ['title' => $cate_array->name, 'breadcrumbs' => $breadcrumbs];
		$this->setLayout($layout);
		$this->setView($view);
		$this->layout->content = \View::make($this->view)->with($data);
	}
}