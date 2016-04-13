<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 06/01/2015
 * Time: 9:35 CH
 */

namespace Noweb\Cp;

class News extends BaseModel {

	protected $table = 'news';

	protected $url;

	protected $openTarget;

	/*  Api process */
	public static function api($action) {

		switch ($action) {
			case 'count':
				$news_num = \DB::table('news')->count();
				return $news_num;
				break;

			case 'insert':
				if (!\Input::has('title')) {
					Api::error('WTF?');
					return false;
				}
				$result = 'ok insert ok';

				return $result;
				break;

			default:
				# code...
				break;
		}
	}

	public function getThumbnail() {
		$urlService = new \App\Service\URLService($this);
		return $urlService->getThumbnailUrl();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function category() {

		return $this->belongsToMany('\Noweb\Cp\Category', 'news_categories', 'news_id', 'category_id');
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function newsComment() {
		return $this->hasMany('\Noweb\Cp\NewsComment', 'news_id', 'id');
	}
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function user() {

		return $this->hasOne('\Noweb\Cp\User', 'id', 'user_id');
	}

	public function getLatestNewsOrder() {
		$domainService = new \Noweb\Cp\DomainService();
		$domainId = $domainService->getDomain()->id;
		$news = $this->where('domain_id', '=', $domainId)->orderby('order_num', 'desc')->first();
		return empty($news) ? null : $news;
	}

	public function deleteNews($ids = null) {
		/** Delete all news comment */
		if (!$ids && $this->id) {
			\DB::table('news_comments')
				->where('news_id', '=', $this->id)
				->delete();
			$this->delete();
			return true;
		}
		if (is_array($ids)) {
			\DB::table('news_comments')
				->whereIn('news_id', $ids)
				->delete();
			\DB::table($this->table)
				->whereIn('id', $ids)
				->delete();
			return true;
		}
	}

	/**
	 * @param array $tags
	 * @use Insert if tag does
	 */
	public function updateTags(array $tags) {
		$tagInsert = [];
		foreach ($tags as $tag) {
			$tagInsert[] = ['obj_id' => $this->id, 'tag_id' => $tag, 'obj_type' => 'news'];

		}
		\DB::table('tags_view')->where('obj_id', '=', $this->id)->where('obj_type', '=', 'news')->delete();
		\DB::table('tags_view')->insert($tagInsert);
	}

	/**
	 * @param array $cIds
	 * @use Update news category
	 */
	public function updateCategoryIds(array $cIds) {
		$cateInsert = [];
		foreach ($cIds as $cate) {
			$cateInsert[] = ['news_id' => $this->id, 'category_id' => $cate];
		}
		\DB::table('news_categories')->where('news_id', '=', $this->id)->delete();
		\DB::table('news_categories')->insert($cateInsert);

	}

	/**
	 * @return category ids
	 */
	public function getCategoryIds() {
		$cIds = [];
		foreach ($this->category as $cate) {
			$cIds[] = $cate->id;
		}
		return $cIds;
	}

	public function getTagIds() {

		$tags = \DB::table('tags_view')->where('obj_id', '=', $this->id)->where('obj_type', '=', 'news')->lists('tag_id');
		return $tags;
	}

}