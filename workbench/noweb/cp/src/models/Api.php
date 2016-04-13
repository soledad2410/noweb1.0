<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 07/01/2015
 * Time: 1:41 CH
 */

namespace Noweb\Cp;

class Api extends BaseModel {

	/* How to call

	Url: api/method_name

	Example: api/post

	With parameter

	Url: api/method_name?action=action_name&key1=val1

	Example: api/post?action=insert
	{send POST data to above url for insert new post}

	 */

	private static $message = '';

	public static function error($str) {
		self::$message = $str;
	}

	public function index($funcName = 'default') {

		$result = array('error' => 'no', 'message' => '');

		if (!$result['data'] = self::$funcName()) {
			$result['error'] = 'yes';

			$result['message'] = self::$message;
		}

		$result = json_encode($result);

		return $result;
	}

	public function post() {
		$val = \Input::get('ac');
		return $val . 'ok okpost';

	}

	public function news() {

		$action = \Input::get('action');

		if (!\Input::has('action')) {
			self::$message = 'Data not valid';
			return false;
		}

		if (!$result = News::api($action)) {
			return false;
		}

		return $result;
	}

	public function category() {

		return 'ok okcategory';

	}
	public function comment() {

		return 'ok okcomment';

	}
	public function contact() {

		return 'ok okcontact';

	}
	public function system() {

		return 'ok oksystem';

	}
	public function product() {

		$action = \Input::get('action');

		if (!\Input::has('action')) {
			self::$message = 'Data not valid';
			return false;
		}

		if (!$result = Product::api($action)) {
			return false;
		}

		return $result;

	}
	public function user() {

		return 'ok okuser';
	}

	public function visitors() {
		$action = \Input::get('action');

		if (!\Input::has('action')) {
			self::$message = 'Data not valid';
			return false;
		}
		switch ($action) {
			case 'set':
				if (!$result = WebVisitor::api($action)) {
					return false;
				}
				break;

			case 'get':
				if (!$result = VisitorStatistics::api($action)) {
					return false;
				}
				break;

			default:
				# code...
				break;
		}
		return $result;
	}

	public function module() {
		$action = \Input::get('action');

		if (!\Input::has('action')) {
			self::$message = 'Data not valid';
			return false;
		}

		if (!$result = Themes::api($action)) {
			return false;
		}
		return $result;
	}

	public function getCommentsUnapproved() {
		$table = 'news_comments';
		$unapproved_comments['comments'] = \DB::table($table)
			->where('status', '=', 0)
			->orderby('created_at', 'DESC')
			->limit(5)
			->get();
		$count = \DB::table($table)
			->where('status', '=', 0)
			->count();
		$unapproved_comments['count'] = $count;
		return $unapproved_comments;
	}

	public function checkIsOnline() {
		session_start();
		$table = 'users_online';
		$session_id = session_id();
		$cur_time = date('Y-m-d H:i:s');
		$check_time = date('Y-m-d H:i:s', strtotime(date('H:i:s')) - 90);

		// Check user is online
		$session_is_exists = \DB::table($table)
			->where('session', '=', $session_id)
			->count();
		if ($session_is_exists > 0) {
			\DB::table($table)
				->where('session', '=', $session_id)
				->update([
					'updated_at' => $cur_time,
				]);
		} else {
			\DB::table($table)
				->insert([
					'session' => $session_id,
					'created_at' => $cur_time,
					'updated_at' => $cur_time,
				]);
		}

		// Delete session after 90 seconds
		\DB::table($table)
			->where('updated_at', '<', $check_time)
			->delete();

		// Count users online
		$users_online = \DB::table($table)->count();
		return $users_online;
	}

	public function getArticles() {
		$table = 'news';
		$comment_table = 'news_comments';
		$type = \Input::get('type');
		$limit = 5;
		switch ($type) {
			case 'new':
				$article = \DB::table($table)
					->select('id', 'name', 'slug', 'thumbnail', 'brief')
					->orderby('created_at', 'DESC')
					->limit($limit)
					->get();
				break;

			case 'view':
				$article = \DB::table($table)
					->select('id', 'name', 'slug', 'thumbnail', 'brief')
					->orderby('view', 'DESC')
					->limit($limit)
					->get();
				break;

			case 'comments':
				$article = \DB::table($table)
					->select($table . '.id', $table . '.name', $table . '.slug', $table . '.thumbnail', $table . '.brief', \DB::raw('COUNT(' . $comment_table . '.id) comment_num'))
					->leftJoin($comment_table, $table . '.id', '=', $comment_table . '.news_id')
					->groupby($table . '.id')
					->orderby('comment_num', 'DESC')
					->limit($limit)
					->get();
				break;

			default:
				$article = \DB::table($table)
					->select('id', 'name', 'slug', 'thumbnail', 'brief')
					->orderby('created_at', 'DESC')
					->limit($limit)
					->get();
				break;
		}
		$news = new \Noweb\Cp\News;
		$urlService = new \App\Service\URLService($news);
		foreach ($article as $a) {
			$a->url = $urlService->getViewLink();
			$a->thumbnail = $urlService->getThumbnailUrl() . $a->thumbnail;
		}
		return $article;
	}
}