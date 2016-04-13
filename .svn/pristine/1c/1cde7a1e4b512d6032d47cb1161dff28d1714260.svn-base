<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 5/7/2015
 * Time: 6:01 PM
 */

namespace Noweb\Cp;
use \App\Service\URLService;
use \Noweb\Cp\DomainService;
use \Noweb\Cp\Gallery;
use \Noweb\Cp\Media;
use \Noweb\Cp\Paginator\Paginator;

class GalleryController extends BaseController {

	public function index() {
		$this->layout->meta = ['title' => 'Trang quản lý album ảnh'];
		$domain = new DomainService();
		$domainId = $domain->getDomain()->id;
		$langId = $this->current_language->id;
		$_SESSION['ck']['private'] = false;
		$_SESSION['ck']['inventoryUpload'] = false;
		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 5;
		$offset = ($currentPage - 1) * $limit;
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'order_num';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'ASC';
		$galleries = Gallery::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $this->current_language->id)
			->where(function ($query) {
				if (\Input::has('cat') && \Input::get('cat') != 'all') {
					$query->where('parent_id', '=', \Input::get('cat'));
				}
			})
			->where(function ($query) {
				if (\Input::has('status') && \Input::get('status') != 'all') {
					$query->where('status', '=', \Input::get('status'));
				}
			})
			->where(function ($query) {
				if (\Input::has('type') && \Input::get('type') != 'all') {
					$query->where('type', '=', \Input::get('type'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('from')) > 0) {
					$query->where('created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('to')) > 0) {
					$query->where('created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::has('keyword')) > 0) {
					$query->where('name', 'LIKE', '%' . \Input::get('keyword') . '%');
				}
			})
			->orderby($sortBy, $sort)
			->skip($offset)
			->take($limit)
			->get();
		$total = Gallery::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $this->current_language->id)
			->where(function ($query) {
				if (\Input::has('cat') && \Input::get('cat') != 'all') {
					$query->where('parent_id', '=', \Input::get('cat'));
				}
			})
			->where(function ($query) {
				if (\Input::has('status') && \Input::get('status') != 'all') {
					$query->where('status', '=', \Input::get('status'));
				}
			})
			->where(function ($query) {
				if (\Input::has('type') && \Input::get('type') != 'all') {
					$query->where('type', '=', \Input::get('type'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('from')) > 0) {
					$query->where('created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('to')) > 0) {
					$query->where('created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::has('keyword')) > 0) {
					$query->where('name', 'LIKE', '%' . \Input::get('keyword') . '%');
				}
			})
			->get()->count();

		$paginator = new Paginator($total, $limit, null, null, 5);
		$galleryObj = new Gallery();
		// Categories trees
		$categories = Category::where('domain_id', '=', $domain->getDomain()->id)->where('language_id', '=', $this->current_language->id)->get();
		$cateObj = new Category();
		$catesArray = $categories->toArray();
		$catTrees = $cateObj->buildHierarchicalCategories($catesArray, 0);
		$this->layout->content = \View::make($this->default_view)->with([
			'galleries' => $galleries,
			'tableTree' => $galleryObj->generateTableTrees($galleries->toArray(), 0),
			'selectTree' => $cateObj->generateSelectBoxTrees($catTrees, 0),
			'paginator' => $paginator->generatePaginator(),
			'range' => $paginator->getResultRange(),
			'catalogues' => Category::where('domain_id', $domainId)->where('language_id', $langId)->where('type', 'album')->get(),
		]);
	}

	public function create() {
		/** add new gallery */
		if (\Input::has('name')) {
			$domain = new DomainService();
			$_SESSION['ck']['private'] = false;
			$_SESSION['ck']['inventoryUpload'] = false;
			$domainId = $domain->getDomain()->id;
			$langId = $this->current_language->id;

			$validator = \Validator::make(\Input::all(),
				[
					'name' => 'required|unique:galleries,name,NULL,id,domain_id,' . $domainId,
					'code' => 'required|unique:galleries,code,NULL,id,domain_id,' . $domainId,
				]);

			$gallery = new Gallery();
			$urlService = new URLService($gallery);
			$gallery->bindData(\Input::all());
			$gallery->language_id = $langId;
			$gallery->domain_id = $domainId;
			if (\Input::get('image')) {
				$image = str_replace($urlService->getUploadPath(), '', \Input::get('image'));
				$gallery->image = $image;
			}
			// return \Input::get('category_id');
			if ($gallery->save()) {
				$gallery->image = $urlService->getUploadPath() . $gallery->image;
				return ['code' => 'success', 'msg' => 'Đăng sản phẩm thành công', 'gallery' => $gallery];
			}

		}
	}
	public function get() {
		if (\Input::has('id')) {
			$_SESSION['ck']['private'] = false;
			$_SESSION['ck']['inventoryUpload'] = false;
			$id = \Input::get('id');
			$gallery = Gallery::find($id);
			$gallery->image = $gallery->getThumbnailUrl();
			if ($gallery) {
				return \Response::json($gallery->toArray());
			}
		}
	}
	public function edit($id = null) {
		/** post update */
		$_SESSION['ck']['private'] = false;
		$_SESSION['ck']['inventoryUpload'] = false;
		$user_id = \Auth::user()->getAuthIdentifier();
		$domainService = new DomainService();
		$domainId = $domainService->getDomain()->id;

		/** Edit submit */
		if (!is_null($id)) {
			if (count(\Input::all()) > 2) {
				$gallery = Gallery::find($id);
				if ($gallery) {
					if (\Input::has('name') && \Input::has('name')) {
						/** Validator */
						$validator = \Validator::make(\Input::all(),
							[
								'name' => 'required|unique:galleries,name,' . $gallery->name . ',name,domain_id,' . $domainId,
								'slug' => 'required|unique:galleries,slug,' . $gallery->slug . ',slug,domain_id,' . $domainId,
							]);
						if ($validator->fails()) {
							return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
						}
					}
					$urlService = new \App\Service\URLService($gallery);
					$gallery->bindData(\Input::all());

					/** Update thumbnail */
					if (\Input::get('image')) {
						$image = str_replace($urlService->getUploadPath(), '', \Input::get('image'));
						$gallery->image = $image;
					}
					if ($gallery->save()) {
						return \Response::json(['code' => 'success', 'msg' => 'Cập nhật album thành công']);
					}
				}
			} else {
				if (\Input::has('status')) {
					$status = \Input::get('status');
					if (
						\DB::table('galleries')
						->where('id', '=', $id)
						->update(['status' => $status, 'update_by' => $user_id])
					) {
						return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin thành công']);
					} else {
						return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
					};
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
			}
		}
	}

	/** Delete */
	public function delete() {
		$id = \Input::get('id');
		if (!is_array($id)) {
			$gallery = Gallery::find($id);
			if ($gallery) {
				if ($gallery->deleteGallery($id)) {
					return \Response::json(['code' => 'success']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa album thất bại']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Album không tồn tại hoặc đã bị xóa']);
		} else {
			$gallery = new Gallery();
			if ($gallery->deleteGallery($id)) {
				return \Response::json(['code' => 'success']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa album thất bại']);
		}
	}

	/**
	 * Save categories order
	 * @return void
	 */
	public function saveOrder() {
		$positions = \Input::get('position');
		$domainService = new DomainService();
		$domainId = $domainService->getDomain()->id;
		foreach ($positions as $id => $position) {
			$cate = Gallery::find($id);
			\DB::table('galleries')
				->where('domain_id', '=', $domainId)
				->where('id', '=', $id);
			$cate->order_num = $position;
			$cate->save();
		}
		return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thành công!']);
	}

	public function album($gallery_id = null) {
		$this->layout->meta = ['title' => 'Trang quản lý album ảnh'];
		$domain = new DomainService();
		$domainId = $domain->getDomain()->id;
		$langId = $this->current_language->id;
		$_SESSION['ck']['private'] = false;
		$_SESSION['ck']['inventoryUpload'] = false;
		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 9;
		$offset = ($currentPage - 1) * $limit;
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'order_num';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'ASC';
		$medias = \Noweb\Cp\Media::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $this->current_language->id)
			->where('gallery_id', '=', $gallery_id)
			->where(function ($query) {
				if (\Input::has('status') && \Input::get('status') != 'all') {
					$query->where('status', '=', \Input::get('status'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::has('keyword')) > 0) {
					$query->where('name', 'LIKE', '%' . \Input::get('keyword') . '%');
				}
			})
			->orderby($sortBy, $sort)
			->skip($offset)
			->take($limit)
			->get();
		$total = \Noweb\Cp\Media::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $this->current_language->id)
			->where('gallery_id', '=', $gallery_id)
			->where(function ($query) {
				if (\Input::has('status') && \Input::get('status') != 'all') {
					$query->where('status', '=', \Input::get('status'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::has('keyword')) > 0) {
					$query->where('name', 'LIKE', '%' . \Input::get('keyword') . '%');
				}
			})
			->get()->count();

		$paginator = new Paginator($total, $limit, null, null, 5);
		// Categories trees
		$galleries = Gallery::where('domain_id', '=', $domain->getDomain()->id)->where('language_id', '=', $this->current_language->id)->get();
		$gaObj = new Gallery();
		$gasArray = $galleries->toArray();
		$trees = $gaObj->buildHierarchicalGalleries($gasArray, 0);
		$this->layout->content = \View::make($this->default_view)->with([
			'tableTree' => $gaObj->generateTableTrees($gasArray, 0),
			'selectTree' => $gaObj->generateSelectBoxTrees($trees, 0),
			'paginator' => $paginator->generatePaginator(),
			'range' => $paginator->getResultRange(),
			'galleries' => $galleries,
			'medias' => $medias,
			'gallery_id' => $gallery_id,
		]);
	}
	public function addMedia() {
		if (\Input::has('name')) {
			$domain = new DomainService();
			$_SESSION['ck']['private'] = false;
			$_SESSION['ck']['inventoryUpload'] = false;
			$domainId = $domain->getDomain()->id;
			$langId = $this->current_language->id;

			$validator = \Validator::make(\Input::all(),
				[
					'name' => 'required|unique:media,name,NULL,id,domain_id,' . $domainId,
					'slug' => 'required|unique:media,slug,NULL,id,domain_id,' . $domainId,
				]);

			$media = new Media();
			$urlService = new URLService($media);
			$media->bindData(\Input::all());
			$media->language_id = $langId;
			$media->domain_id = $domainId;
			if (\Input::get('image')) {
				$image = str_replace($urlService->getUploadPath(), '', \Input::get('image'));
				$media->image = $image;
				$media->thumbnail = $image;
			}
			// return \Input::get('category_id');
			if ($media->save()) {
				$media->image = $urlService->getUploadPath() . $media->image;
				return ['code' => 'success', 'msg' => 'Đăng media thành công', 'media' => $media];
			}
		}
	}
	public function getMedia() {
		if (\Input::has('id')) {
			$_SESSION['ck']['private'] = false;
			$_SESSION['ck']['inventoryUpload'] = false;
			$id = \Input::get('id');
			$media = Media::find($id);
			$media->image = $media->getThumbnailUrl();
			if ($media) {
				return \Response::json($media->toArray());
			}
		}
	}
	public function saveMedia() {
		$domain = new DomainService();
		$domain_id = $domain->getDomain()->id;
		$_SESSION['ck']['private'] = false;
		$_SESSION['ck']['inventoryUpload'] = false;
		if (\Input::has('name')) {
			$media = Media::find(\Input::get('id'));
			if ($media) {
				$urlService = new \App\Service\URLService($media);
				$media->bindData(\Input::all());

				/** Update thumbnail */
				if (\Input::get('image')) {
					$image = str_replace($urlService->getUploadPath(), '', \Input::get('image'));
					$media->image = $image;
					$media->thumbnail = $image;
				}
				if ($media->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Cập nhật chi tiết media thành công']);
				}
			}
		}
	}
	public function deleteMedia() {
		$id = \Input::get('id');
		if (!is_array($id)) {
			$media = Media::find($id);
			if ($media) {
				if ($media->deleteMedia($id)) {
					return \Response::json(['code' => 'success']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa media thất bại']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Media không tồn tại hoặc đã bị xóa']);
		} else {
			$media = new Gallery();
			if ($media->deleteMedia($id)) {
				return \Response::json(['code' => 'success']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa media thất bại']);
		}
	}
}