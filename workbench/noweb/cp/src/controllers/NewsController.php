<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 06/12/2014
 * Time: 6:28 CH
 */

namespace Noweb\Cp;
use Illuminate\Support\Facades\Auth;
use \App\Service\URLService;
use \Noweb\Cp\CachingService;
use \Noweb\Cp\DomainService;
use \Noweb\Cp\News;
use \Noweb\Cp\NewsComment;
use \Noweb\Cp\Paginator\Paginator;
use \Noweb\Cp\Tag;

class NewsController extends BaseController {

	public function index() {
		$this->layout->meta = ['title' => 'Trang quản lý tin tức website'];
		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 10;
		$offset = ($currentPage - 1) * $limit;
		$domain = new DomainService();

		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'created_at';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'DESC';
		// Get list news
		$newss = News::leftJoin('news_categories', 'news.id', '=', 'news_categories.news_id')
			->leftJoin('categories', 'news_categories.category_id', '=', 'categories.id')
			->where('news.domain_id', '=', $domain->getDomain()->id)
			->where('news.language_id', '=', $this->current_language->id)
			->where(function ($query) {
				if (\Input::has('status') && \Input::get('status') != 'all') {
					$query->where('news.status', '=', \Input::get('status'));
				}
			})
			->where(function ($query) {
				if (\Input::has('category_id') && \Input::get('category_id') != 'all') {
					$query->where('news.category_id', '=', \Input::get('category_id'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('from')) > 0) {
					$query->where('news.created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('to')) > 0) {
					$query->where('news.created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('cat')) > 0) {
					$query->where('categories.id', '=', \Input::get('cat'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::has('keyword')) > 0) {
					$query->where('news.name', 'LIKE', '%' . \Input::get('keyword') . '%');
				}
			})
			->groupby('news.id')
			->orderby($sortBy, $sort)
			->skip($offset)
			->take($limit)->get(
			[
				\DB::Raw('group_concat(news_categories.category_id) as cat_id'),
				\DB::Raw('group_concat(categories.name) as cat_name'),
				'news.*',
			]
		);
		// return $newss;
		// return $queries = \DB::getQueryLog();
		$total = News::leftJoin('news_categories', 'news.id', '=', 'news_categories.news_id')
			->leftJoin('categories', 'news_categories.category_id', '=', 'categories.id')
			->where('news.domain_id', '=', $domain->getDomain()->id)
			->where('news.language_id', '=', $this->current_language->id)
			->where(function ($query) {
				if (\Input::has('status') && \Input::get('status') != 'all') {
					$query->where('news.status', '=', \Input::get('status'));
				}
			})
			->where(function ($query) {
				if (\Input::has('category_id') && \Input::get('category_id') != 'all') {
					$query->where('news.category_id', '=', \Input::get('category_id'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('from')) > 0) {
					$query->where('news.created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('to')) > 0) {
					$query->where('news.created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('cat')) > 0) {
					$query->where('categories.id', '=', \Input::get('cat'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::has('keyword')) > 0) {
					$query->where('news.name', 'LIKE', '%' . \Input::get('keyword') . '%');
				}
			})->groupby('news.id')->get(['news.id'])->count();
		$paginator = new Paginator($total, $limit, null, null, 5);

		$_SESSION['ck']['private'] = false;
		$_SESSION['ck']['inventoryUpload'] = false;
		/** Get exist Cache */
		$cacheService = new CachingService();
		$newsCache = json_decode($cacheService->get('news'));
		if (!$newsCache) {
			$newsCache = new News();
		}

		$relatedNews = News::whereIn('id', explode('|', $newsCache->related_news))->where('language_id', $this->current_language->id)->select('id', 'name', 'status')->get();
		$newssAjax = News::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', $this->current_language->id)
			->orderby($sortBy, $sort)
			->skip($offset)
			->take($limit)->get();
		/** Categories tree view */
		$categories = Category::where('domain_id', '=', $domain->getDomain()->id)
			->where('language_id', '=', $this->current_language->id)
		// ->where('type', '=', 'news')
		->orderby($sortBy, $sort)->get(['id', 'parent_id', 'name', 'slug', 'created_at', 'type']);
		$cateObj = new Category();
		$catesArray = $categories->toArray();
		$trees = $cateObj->buildHierarchicalCategories($catesArray, 0);
		$tagIds = explode('|', $newsCache->tags);
		$selectedTags = empty($tagIds) ? [] : Tag::whereIn('id', $tagIds)->get();
		$this->layout->content = \View::make($this->default_view)
			->with([
				'paginator' => $paginator->generatePaginator(),
				'newss' => $newss,
				'range' => $paginator->getResultRange(),
				'newsCache' => $newsCache,
				'ajaxPaginator' => $paginator->generateAjaxPaginator('/cp/news/get'),
				'newssAjax' => $newssAjax,
				'relatedNews' => $relatedNews,
				'checkboxTreeView' => $cateObj->generateCheckboxTrees($trees, 'name="categories[]"', [], ['news']),
				'selectTreeView' => $cateObj->generateSelectBoxTrees($trees, 'name="categories[]"'),
				'tags' => Tag::where('domain_id', '=', $domain->getDomain()->id)->where('language_id', '=', $this->current_language->id)->get(),
				'selectedTags' => $selectedTags,
			]);
	}

	public function get($id = null) {

		$domain = new DomainService();
		if ($id) {
			$news = News::with(['category' => function ($query) {
				$query->select('id', 'name');
			}, 'user' => function ($query) {
				$query->select('id', 'username');
			},
			])->where('domain_id', '=', $domain->getDomain()->id)
			  ->where('language_id', '=', $this->current_language->id)
			  ->where('id', '=', $id)->first();
			if (!empty($news)) {
				$urlService = new \App\Service\URLService($news);
				$imageExt = array('jpg', 'png', 'jpeg', 'gif', 'bmp');
				$explode = explode('.', $urlService->getThumbnailUrl());
				if (in_array(end($explode), $imageExt)) {
					$news->thumbnail = $urlService->getThumbnailUrl();
				} else {
					$news->thumbnail = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image';
				}
				$news->url = $urlService->getViewLink();

				return \Response::json($news->toArray());
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Tin tức không tồn tại hoặc đã bị xóa']);
			}

		} else {
			$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
			$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 20;
			$offset = ($currentPage - 1) * $limit;
			$domain = new DomainService();
			$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'created_at';
			$sort = \Input::has('sort') ? \Input::get('sort') : 'DESC';
			$newss = News::with(['category' => function ($query) {
				$query->select('id', 'name');
			},
			])
				->where('domain_id', '=', $domain->getDomain()->id)->where('language_id', '=', $this->current_language->id);
			if (trim(\Input::get('keyword')) != '') {
				$newss = $newss->where('name', 'LIKE', '%' . \Input::get('keyword') . '%');
			}
			if (\Input::get('category_id') == 'all') {
				$newss = $newss->where('category_id', 'IS', 'NULL');
			}
			if (intval(\Input::get('category_id')) > 0) {
				/** Get news by specify category (recursive) */
				/**........
			 *
			 */
			}
			$total = $newss->count();
			$paginator = new Paginator($total, $limit, null, null, 5);

			$newss = $newss->orderby($sortBy, $sort)
			               ->skip($offset)
			               ->take($limit)->select('id', 'name', 'category_id', 'status')->get();
			return \Response::json(['code' => 'success', 'data' => $newss->toArray(), 'paginator' => $paginator->generateAjaxPaginator('/cp/news/get?category_id=' . \Input::get('category_id') . '&keyword=' . \Input::get('keyword')), 'range' => $paginator->getResultRange(), 'total' => $total]);
		}
	}

	public function create() {

		$domainService = new DomainService();
		$domainId = $domainService->getDomain()->id;
		$validator = \Validator::make(\Input::all(),
			[
				'name' => 'required|unique:news,name,NULL,id,domain_id,' . $domainId,
				'slug' => 'required|unique:news,slug,NULL,id,domain_id,' . $domainId,
			]);
		if ($validator->fails()) {
			return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
		}
		$news = new \Noweb\Cp\News();
		$news->bindData(\Input::all());
		$urlService = new \App\Service\URLService($news);
		if (\Input::get('thumbnail')) {
			$thumbnail = str_replace($urlService->getUploadPath(), '', \Input::get('thumbnail'));
			$news->thumbnail = $thumbnail;
		}
		$news->domain_id = $domainId;
		$news->order_num = 1;
		$news->user_id = \Auth::user()->getAuthIdentifier();
		$news->language_id = $this->current_language->id;
		$latestNewsOrder = $news->getLatestNewsOrder();
		if ($latestNewsOrder) {
			$news->order_num = $latestNewsOrder->order_num + 1;
		}
		$news->published_time = getDatetime($news->published_time);
		$news->expire_time = getDatetime($news->expire_time);
		/** Categories */
		$cates = \Input::get('categories');
		/** News tags */
		$tags = explode('|', \Input::get('tags'));
		if ($news->save()) {
			// Insert tags
			$id = $news->id;
			$tagInsert = [];
			foreach ($tags as $tag) {
				$tagInsert[] = ['obj_id' => $id, 'tag_id' => $tag, 'obj_type' => 'news'];
			}
			\DB::table('tags_view')->insert($tagInsert);
			// Insert categories //
			$cateInsert = [];
			if (count($cates) == 0) {
				$cateInsert[] = ['news_id' => $id, 'category_id' => 0];
			} else {
				foreach ($cates as $cate) {
					$cateInsert[] = ['news_id' => $id, 'category_id' => $cate];
				}
			}
			\DB::table('news_categories')->insert($cateInsert);
			/** @var  $cacheService */
			$cacheService = new CachingService();
			$cacheService->delete('news');
			return \Response::json(['code' => 'success', 'msg' => 'Thêm mới bài viết thành công', 'id' => $id]);
		} else {
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, thêm mới bài viết thất bại']);
		}
	}

	public function edit($id = null) {
		/** post update */
		$user_id = \Auth::user()->getAuthIdentifier();
		$domainService = new DomainService();
		$domainId = $domainService->getDomain()->id;

		/** Edit news details page */
		if (intval($id) > 0) {
			$newsId = $id;
			/** @var  $news News */
			$news = News::with(['user' => function ($query) {
				$query->select('id', 'username');
			},
			])->where('domain_id', '=', $domainId)
			  ->where('language_id', '=', $this->current_language->id)
			  ->where('id', '=', $newsId)->first();
			if (empty($news)) {
				return \Redirect::route('cp-404');
			}
			$_SESSION['ck']['private'] = false;

			/** Get exist Cache */
			$urlService = new \App\Service\URLService($news);
			empty($news->thumbnail) || $news->thumbnail = $urlService->getThumbnailUrl();
			$news->url = $urlService->getViewLink();
			$newsCache = $news;
			$limit = 10;
			$relatedNews = News::whereIn('id', explode('|', $newsCache->related_news))->where('language_id', $this->current_language->id)->select('id', 'name', 'status')->get();
			$total = News::where('domain_id', '=', $domainId)->where('language_id', $this->current_language->id)->count();
			$paginator = new Paginator($total, $limit, null, null, 5);
			$newssAjax = News::where('domain_id', '=', $domainId)
				->where('language_id', $this->current_language->id)
				->skip(0)
				->take(10)->get();

			/** Categories tree view */
			$categories = Category::where('domain_id', '=', $domainId)
				->where('language_id', '=', $this->current_language->id)
			// ->where('type', '=', 'news')
			->get(['id', 'parent_id', 'name', 'slug', 'type', 'created_at']);
			$cateObj = new Category();
			$catesArray = $categories->toArray();
			$trees = $cateObj->buildHierarchicalCategories($catesArray, 0);
			$tagsIds = $news->getTagIds();
			$seletedTags = empty($tagsIds) ? [] : Tag::whereIn('id', $tagsIds)->get();
			$this->layout->meta = ['title' => 'Sửa thông tin bài viết'];
			$this->layout->content = \View::make($this->default_view)
				->with(['newsCache' => $news,
					'ajaxPaginator' => $paginator->generateAjaxPaginator('/cp/news/get'),
					'newssAjax' => $newssAjax,
					'relatedNews' => $relatedNews,
					'range' => $paginator->getResultRange(),
					'checkboxTreeView' => $cateObj->generateCheckboxTrees($trees, 'name="categories[]"', $news->getCategoryIds(), ['news']),
					'tags' => Tag::where('domain_id', '=', $domainId)->where('language_id', '=', $this->current_language->id)->get(),
					'selectedTags' => $seletedTags,
				]);
		}

		/** Edit submit news  */
		if (\Input::has('id')) {
			$newsId = \Input::get('id');
			if (!is_array($newsId) && !\Input::has('status')) {
				$news = \Noweb\Cp\News::find($newsId);
				if ($news) {
					/** Except quick change order number */
					$news->update_by = $user_id;
					if (!\Input::has('order_num')) {
						/** Validator */
						$validator = \Validator::make(\Input::all(),
							[
								'name' => 'required|unique:news,name,' . $news->name . ',name,domain_id,' . $domainId,
								'slug' => 'required|unique:news,slug,' . $news->slug . ',slug,domain_id,' . $domainId,
							]);
						if ($validator->fails()) {
							return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
						}
						$urlService = new \App\Service\URLService($news);
						$news->bindData(\Input::all());

						/** Update status */
						if (intval($id) > 0) {
							$news->show_home = \Input::has('show_home') ? 1 : 0;
							$news->show_hot = \Input::has('show_hot') ? 1 : 0;
							$news->comment_allowed = \Input::has('comment_allowed') ? 1 : 0;
						}
						/** Update tags */
						if (\Input::has('tags')) {
							$tags = explode('|', \Input::get('tags'));
							$news->updateTags($tags);
						}

						/** Update categories */
						$cates = [];
						if (\Input::has('categories')) {
							$cates = \Input::get('categories');
						}
						$news->updateCategoryIds($cates);
						/** Update thumbnail */
						if (\Input::get('thumbnail')) {
							$thumbnail = str_replace($urlService->getUploadPath(), '', \Input::get('thumbnail'));
							$news->thumbnail = $thumbnail;
						}
						$news->last_update = date('Y-m-d H:i');
						$news->update_by = $user_id;
						if ($news->save()) {
							return \Response::json(['code' => 'success', 'msg' => 'Cập nhật bài viết thành công', 'redirect' => '/cp/news']);
						}
					}

					/** Change order num */
					if (\Input::has('order_num')) {
						$currentOrder = $news->order_num;
						\DB::table('news')
							->where('order_num', '=', \Input::get('order_num'))
							->where('domain_id', '=', $domainId)
							->update(array('order_num' => $news->order_num, 'update_by' => $user_id));
						$news->order_num = \Input::get('order_num');
						$news->save();
						return \Response::json(['code' => 'success', 'order_num' => $currentOrder]);
					}
				}

			} else {
				if (\Input::has('status')) {
					$status = \Input::get('status');
					if (\DB::table('news')->whereIn('id', $newsId)->update(['status' => $status, 'last_update' => date('Y-m-d H:i'), 'update_by' => $user_id])) {
						return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin thành công']);
					} else {
						return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
					};
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
			}
		}
	}

	/** Delete news */
	public function delete() {
		$id = \Input::get('id');
		if (!is_array($id)) {
			$news = \Noweb\Cp\News::find($id);
			if ($news) {
				if ($news->deleteNews()) {
					return \Response::json(['code' => 'success']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thông tin thất bại']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Bài viết không tồn tại hoặc đã bị xóa']);
		} else {
			$news = new News();
			if ($news->deleteNews($id)) {
				return \Response::json(['code' => 'success']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thông tin thất bại']);
			};
		}
	}

	public function comments() {
		$this->layout->meta = ['title' => 'Trang quản lý bình luận'];

		$currentPage = intval(\Input::get('page')) > 0 ? \Input::get('page') : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 7;
		$offset = ($currentPage - 1) * $limit;
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'news_comments.id';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'ASC';
		// Get categories
		$comments = NewsComment::leftJoin('news_comments AS child', 'news_comments.id', '=', 'child.reply_id')
			->join('news', 'news_comments.news_id', '=', 'news.id')
			->where(function ($query) {
				if (!\Input::has('reply_id')) {
					$query->where('news_comments.reply_id', '=', 0);
				}
			})
			->where(function ($query) {
				if (\Input::has('status') && \Input::get('status') != 'all') {
					$query->where('news_comments.status', '=', \Input::get('status'));
				}
			})
			->where(function ($query) {
				if (\Input::has('news_id') && \Input::get('news_id') != 'all') {
					$query->where('news_comments.news_id', '=', \Input::get('news_id'));
				}
			})
			->where(function ($query) {
				if (\Input::has('reply_id')) {
					$query->where('news_comments.reply_id', '=', \Input::get('reply_id'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('from')) > 0) {
					$query->where('news_comments.created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('to')) > 0) {
					$query->where('news_comments.created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::has('keyword')) > 0) {
					$query->where('news_comments.content', 'LIKE', '%' . \Input::get('keyword') . '%');
				}
			})
			->groupby('news_comments.id')
			->orderby($sortBy, $sort)
			->skip($offset)
			->take($limit)->get(
			[
				'news.id AS news_id',
				'news.name AS news_name',
				'news_comments.*',
				\DB::raw('ifnull(COUNT(child.id),0) AS number_child'),
			]
		);
		// Get total records
		$total = NewsComment::leftJoin('news_comments AS child', 'news_comments.id', '=', 'child.reply_id')
			->join('news', 'news_comments.news_id', '=', 'news.id')
			->where(function ($query) {
				if (!\Input::has('reply_id')) {
					$query->where('news_comments.reply_id', '=', 0);
				}
			})
			->where(function ($query) {
				if (\Input::has('approval') && \Input::get('approval') != 'all') {
					$query->where('news_comments.approval', '=', \Input::get('approval'));
				}
			})
			->where(function ($query) {
				if (\Input::has('news_id') && \Input::get('news_id') != 'all') {
					$query->where('news_comments.news_id', '=', \Input::get('news_id'));
				}
			})
			->where(function ($query) {
				if (\Input::has('reply_id')) {
					$query->where('news_comments.reply_id', '=', \Input::get('reply_id'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('from')) > 0) {
					$query->where('news_comments.created_at', '>', date_format(date_create(\Input::get('from')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::get('to')) > 0) {
					$query->where('news_comments.created_at', '<', date_format(date_create(\Input::get('to')), 'Y-m-d'));
				}
			})
			->where(function ($query) {
				if (strlen(\Input::has('keyword')) > 0) {
					$query->where('news_comments.content', 'LIKE', '%' . \Input::get('keyword') . '%');
				}
			})
			->groupby('news_comments.id')->get()->count();
		$paginator = new Paginator($total, $limit, null, null, 5);
		$commentsObj = new NewsComment();

		// Get news list
		$news = News::where('comment_allowed', '=', 1)->get(['id', 'name', 'slug']);
		// Call view
		$this->layout->content = \View::make($this->default_view)
			->with([
				'news' => $news,
				'tableTree' => $commentsObj->generateTableTrees($comments->toArray(), 0),
				'range' => $paginator->getResultRange(),
				'paginator' => $paginator->generatePaginator(),
			]);
	}
	public function getComment() {
		$id = intval(\Input::get('id'));
		$comment = NewsComment::where('id', '=', $id)->first();
		if (!empty($comment)) {
			return \Response::json($comment->toArray());
		} else {
			return \Response::json(['code' => 'error', 'msg' => 'Bình luận không tồn tại hoặc đã bị xóa']);
		}
	}
	public function editComment($id = null) {
		// Update status
		if (count(\Input::all()) == 2 && \Input::has('status')) {
			$id = \Input::get('id');
			$status = intval(\Input::get('status'));
			$comment = NewsComment::find($id);
			if ($comment) {
				$comment->updated_at = date('Y-m-d H:i:s');
				$comment->status = $status;
				if ($comment->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin thành công']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
			}
		}
		// Update comments
		if (intval($id) > 0 && count(\Input::all()) > 2) {
			$comment = NewsComment::find($id);
			if ($comment) {
				$comment->title = \Input::get('title');
				$comment->content = \Input::get('content');
				$comment->updated_at = date('Y-m-d H:i:s');
				if ($comment->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin thành công']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Bình luận không tồn tại hoặc đã bị xóa']);
			}

		}
	}
	public function deleteComment() {
		$id = \Input::get('id');
		if (!is_array($id)) {
			$comment = NewsComment::find($id);
			if ($comment) {
				if ($comment->deleteComment($id)) {
					return \Response::json(['code' => 'success']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thất bại']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Bình luận không tồn tại hoặc đã bị xóa']);
		} else {
			$comment = new NewsComment();
			if ($comment->deleteComment($id)) {
				return \Response::json(['code' => 'success']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thất bại']);
		}
	}
	public function saveComment() {
		$id = \Input::get('id');
		$pcomment = NewsComment::find($id);
		if ($pcomment) {
			$user = User::find(\Auth::user()->getAuthIdentifier());
			$comment = new NewsComment();
			$comment->reply_id = intval(\Input::get('id'));
			$comment->news_id = intval(\Input::get('news_id'));
			$comment->content = trim(\Input::get('content'));
			$comment->user_id = $user->id;
			$comment->fullname = $user->fullname;
			$comment->email = $user->email;
			$comment->status = 3;
			$comment->view = 1;
			$comment->title = $user->fullname . ' trả lời';
			if ($comment->save()) {
				$pcomment->updated_at = date('Y-m-d H:i:s');
				$pcomment->status = 2;
				if ($pcomment->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Đã trả lời!']);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, không thể trả lời']);
				}
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, không thể trả lời']);
			}
		} else {
			return \Response::json(['code' => 'error', 'msg' => 'Bình luận không tồn tại hoặc đã bị xóa']);
		}
	}
}