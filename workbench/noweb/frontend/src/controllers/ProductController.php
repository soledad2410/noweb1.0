<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 5/13/2015
 * Time: 2:09 PM
 */

namespace Noweb\Frontend;
use \App\Service\URLService;
use \Noweb\Frontend\Category;
use \Noweb\Frontend\Paginator\Paginator;
use \Noweb\Frontend\Product;
use \Noweb\Frontend\ProductProperties;
use \Noweb\Frontend\Url\Url;

class ProductController extends BaseController {

	public function index() {

	}

	public function cate($slug, $page = 1) {

		$limit = 6;
		$slug = strtok($slug, '_');
		$currentPage = intval($page) > 0 ? intval($page) : 1;
		$offset = ($currentPage - 1) * $limit;

		$productObj = new Product();

		$cate = Category::where('slug', $slug)->where('status', 1)->first();

		$urlObj = new Url();
		$breadcrumbs = $urlObj->generate_breadcrumb($cate->id);

		if (isset($cate->id)) {
			$products = $productObj->get(null, null, $cate->id, null, $limit, $offset);
			$total = count($productObj->get(null, null, $cate->id));
		} else {
			\App::abort(404);
		}

		$paginator = new Paginator($total, $limit, null, null, 5);

		$this->extra_data = ['title' => $cate->name, 'breadcrumbs' => $breadcrumbs];
		$this->setLayout();
		$this->setView();
		$this->layout->content = \View::make($this->view)->with(
			[
				'products' => $products,
				'paginator' => $paginator->generatePaginator(),
				'range' => $paginator->getResultRange(),
				'url' => $urlObj,
			]
		);
	}

	public function details($slug, $id) {

		$relatedItemNum = 5;
		$productObj = new Product();

		$urlService = new URLService($productObj);
		$uploadPath = '/' . $urlService->getUploadPath();

		$product = $productObj->get('product.*, categories.id AS cate_id, categories.name AS cate_name', $id);
		if ($product) {
			$product = $product[0];
		} else {
			\App::abort(404);
		}

		$urlObj = new Url();
		$breadcrumbs = $urlObj->generate_breadcrumb($product->cate_id);

		$relatedProducts = $productObj->get('product.id, product.name, product.slug, product.brief, product.thumbnail', null, $product->cate_id);

		$tagsProductID = explode('|', rtrim($product->tags, '|'));

		$productByTags = array();
		foreach ($tagsProductID as $proID) {
			$result = $productObj->get('product.id, product.name, product.slug, product.brief, product.thumbnail', null, null, [['product.id', '!=', $id], ['tags', 'LIKE', '%' . $proID . '%']]);
			$productByTags = array_merge($productByTags, $result);
		}
		$relatedProducts = array_merge($productByTags, $relatedProducts);
		$relatedProducts = array_unique($relatedProducts, SORT_REGULAR);
		$relatedProducts = array_slice($relatedProducts, 0, 5);

		// Get product properties
		$pp = ProductProperties::where('status', '=', 1)->get();

		$this->extra_data = ['title' => $product->name . ' - ' . $product->cate_name, 'breadcrumbs' => $breadcrumbs];
		$this->setLayout();
		$this->setView();
		$this->layout->content = \View::make($this->view)->with(
			[
				'product' => $product,
				'uploadPath' => $uploadPath,
				'relatedProducts' => $relatedProducts,
				'url' => $urlObj,
				'pp' => $pp,
			]
		);
	}
}