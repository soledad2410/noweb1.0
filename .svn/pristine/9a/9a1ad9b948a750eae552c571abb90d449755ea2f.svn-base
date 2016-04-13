<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 11/21/14
 * Time: 11:04 AM
 */

namespace Noweb\Cp;

use Illuminate\Support\Facades\Auth;
use \Noweb\Cp\NewsComment;
use \Noweb\Cp\VisitorStatistics;

class IndexController extends BaseController {

	public function __construct() {
		parent::__construct();

	}

	public function index() {
		if (Auth::user()) {
			return \Redirect::route('cp-dashboard');
		}
		$this->layout = 'cp::layouts.login';
		$this->setupLayout();
		$this->layout->content = \View::make('cp::index.index');
	}

	public function ajaxLogin() {
		/** Check last logged in false */
		$freeze_time = \Config::get('cp::cp.false_logged_freeze_time');
		$max_times = \Config::get('cp::cp.false_logged_times');

		if (\Session::has('false_login')) {
			$false_login = \Session::get('false_login');
			$last = $false_login['time'];
			$times = $false_login['count'];
			if ($times >= $max_times && $last + $freeze_time >= time()) {
				return \Response::json(array('code' => 'freeze', 'time' => $last + $freeze_time - time(), 'msg' => 'Wrong login ' . $max_times . ' times'));
			}
			if ($times >= $max_times && $last + $freeze_time <= time()) {
				\Session::forget('false_login');
			}
		}
		$validator = \Validator::make(\Input::all(), array(
			'username' => 'required|min:6',
			'password' => 'required|min:5',
		));
		if ($validator->fails()) {
			return \Response::json(array('code' => 'false', 'errors' => $validator->errors()->toArray()));
		}
		$auth = \Auth::attempt(array(
			'username' => \Input::get('username'),
			'password' => \Input::get('password'),
			'active' => 1,
		), false);

		if (!$auth) {
			if (\Session::has('false_login')) {
				$false_login = \Session::get('false_login');
				$false_login['count']++;
				$false_login['time'] = time();
			} else {
				$false_login = array();
				$false_login['count'] = 1;
				$false_login['time'] = time();
			}
			\Session::put('false_login', $false_login);
			return \Response::json(array('code' => 'false', 'errors' => array('username' => 'Username or password does not match')));
		}

		/** Login success **/
		if (\Session::has('false_login')) {
			\Session::forget('false_login');
		}
		/** Change status to online */
		/** @var  $user  User */
		$user = User::find(\Auth::user()->getAuthIdentifier());
		$user->status = 1;
		$user->save();
		$user->updateLoginLogs();
		return \Response::json(array('code' => 'success', 'msg' => 'login success!'));

	}

	public function dashboard() {

		// Set visitors data
		$data['visitors'] = array();
		$day = strtotime("+1 day");
		$start_week = strtotime("last sunday midnight", $day);
		$end_week = strtotime("next sunday midnight", $start_week);
		$start = date('Y-m-d H:j:s', $start_week);
		$end = date('Y-m-d H:j:s', $end_week);
		$limit = 7;
		$offset = 0;

		$v_mobile = \Noweb\Cp\VisitorStatistics::where('agent', '=', 'mobile')
			->where('created_at', '>', $start)
			->where('created_at', '<=', $end)
			->orderby('created_at', 'ASC')
			->skip($offset)
			->take($limit)
			->get([
				'day AS mobile_num',
				\DB::raw('DATE(created_at) AS day'),
			]);
		// return $v_mobile;
		$v_web = \Noweb\Cp\VisitorStatistics::where('agent', '=', 'web')
			->where('created_at', '>', $start)
			->where('created_at', '<=', $end)
			->orderby('created_at', 'ASC')
			->skip($offset)
			->take($limit)
			->get([
				'day AS web_num',
				\DB::raw('DATE(created_at) AS day'),
			]);
		// return $v_web;
		if (count($v_mobile) == 0 && count($v_web) == 0) {
			$data['visitors'][0]['day'] = date('Y-m-d');
			$data['visitors'][0]['mobile_num'] = 0;
			$data['visitors'][0]['web_num'] = 0;
		} else {

			if (count($v_mobile) > count($v_web)) {
				foreach ($v_mobile as $key => $mobile) {
					$data['visitors'][$key]['day'] = date_format(date_create($mobile['day']), 'Y-m-d');
					$data['visitors'][$key]['mobile_num'] = $mobile['mobile_num'];
					$data['visitors'][$key]['web_num'] = 0;
				}

				foreach ($v_web as $k => $web) {
					foreach ($v_mobile as $key => $mobile) {
						if ($mobile['day'] == $web['day']) {
							$data['visitors'][$key]['web_num'] = $web['web_num'];
						}
					}
				}
			} else {
				foreach ($v_web as $key => $web) {
					$data['visitors'][$key]['day'] = date_format(date_create($web['day']), 'Y-m-d');
					$data['visitors'][$key]['web_num'] = $web['web_num'];
					$data['visitors'][$key]['mobile_num'] = 0;
				}

				foreach ($v_mobile as $k => $mobile) {
					foreach ($v_web as $key => $web) {
						if ($web['day'] == $mobile['day']) {
							$data['visitors'][$key]['mobile_num'] = $mobile['mobile_num'];
						}
					}
				}
			}

		}

		// Visitors data
		$data['visitors'] = array_values($data['visitors']);

		// Get today visitors statistics
		$daily = VisitorStatistics::where('created_at', 'LIKE', date('Y-m-d') . '%')
			->get([\DB::raw('SUM(visitor_statistics.day) visits')])[0]->visits;
		$visits['daily'] = ($daily) ? $daily : 0;
		// Get this week visitors statistics
		$weekly = VisitorStatistics::where('created_at', '>', $start)
			->where('created_at', '<=', $end)
			->get([\DB::raw('SUM(visitor_statistics.day) visits')])[0]->visits;
		$visits['weekly'] = ($weekly) ? $weekly : 0;
		// Get this month visitors statistics
		$monthly = VisitorStatistics::where('created_at', 'LIKE', date('Y-m') . '%')
			->get([\DB::raw('SUM(visitor_statistics.day) visits')])[0]->visits;
		$visits['monthly'] = ($monthly) ? $monthly : 0;
		// Get all visitors statistics
		$total = VisitorStatistics::get([\DB::raw('SUM(visitor_statistics.day) visits')])[0]->visits;
		$visits['total'] = ($total) ? $total : 0;

		// Set comments list content
		$comments = NewsComment::join('news', 'news_comments.news_id', '=', 'news.id')
			->orderby('news_comments.created_at', 'DESC')->take(5)->get([
			'news_comments.*',
			'news.name AS news_title',
			'news.slug AS news_slug',
		]);
		// return $comments;

		$meta['title'] = 'System Control Panel';
		$meta['header'] = 'Bảng điều khiển quản trị';

		$this->layout->meta = $meta;
		$this->layout->content = \View::make($this->default_view)->with([
			'visitors' => json_encode($data['visitors']),
			'visits' => $visits,
			'comments' => $comments,
		]);
	}

	public function ajaxLogout() {
		/** @var  $user User */
		$user = User::find(\Auth::user()->getAuthIdentifier());
		$user->status = 0;
		$user->save();
		Auth::logout();
		return \Response::json(array('code' => 'success', 'msg' => 'Account logout!'));
	}
}