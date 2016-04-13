<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 12/12/2014
 * Time: 9:35 SA
 */

namespace Noweb\Cp;
use \Noweb\Cp\Paginator\Paginator;
use \Noweb\Cp\User;

class ProfileController extends BaseController {

	public function index() {
		$this->layout->meta = ['title' => ' Trang profile cá nhân'];
		$this->layout->content = \View::make($this->default_view);

	}

	public function activities() {
		$this->layout->meta = ['title' => 'Trang lịch sử đăng nhập người dùng'];
		$currentPage = intval(\Input::get('page')) ? intval(\Input::get('page')) : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 10;
		$offset = ($currentPage - 1) * $limit;
		$total = User::find(\Auth::user()->getAuthIdentifier())->activity()->count();
		$paginator = new Paginator($total, $limit, null, null, 5);
		$loggedLogs = User::find(\Auth::user()->getAuthIdentifier())->activity()->orderBy('logged_time', 'desc')->take($limit)->skip($offset)->get();
		$this->layout->content = \View::make($this->default_view)
			->with([
				'paginator' => $paginator->generatePaginator(),
				'range' => $paginator->getResultRange(),
				'items' => $loggedLogs,
			]);
	}

	public function edit() {
		$_SESSION['ck']['private'] = true;
		$this->layout->meta = ['title' => 'Trang sửa thông tin cá nhân'];
		$this->layout->content = \View::make($this->default_view);
	}

	public function postEdit() {
		/** @var  $user \Noweb\Cp\User */
		$user = \Noweb\Cp\User::find(\Auth::user()->getAuthIdentifier());
		$user->bindData(\Input::all());
		if (\Input::get('avatar')) {
			$dir = \Config::get('cp::cp.userfile_dir') . '/' . $user->username . '/images/';
			$user->avatar = str_replace($dir, '', $user->avatar);
		}
		if (!\Input::get('old_password')) {
			if ($user->save()) {
				return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin thành công']);
			}
		}
		if (\Input::get('old_password')) {
			// Change password
			$validator = \Validator::make(\Input::all(), array(
				'old_password' => 'required',
				'new_password' => 'required|min:6',
				're_password' => 'required|same:new_password',
			));
			if ($validator->fails()) {
				return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
			} else {
				$old_password = \Input::get('old_password');
				$password = \Input::get('new_password');
				if (\Hash::check($old_password, $user->password)) {
					// Password provided matches!
					$user->password = \Hash::make($password);
					// Change password
					if ($user->save()) {
						return \Response::json(['code' => 'success', 'msg' => 'Sửa mật khẩu thành công']);
					}
				} else {
					return \Response::json(['code' => 'error', 'errors' => ['old_password' => ['Password input does not match']]]);
				}
			}
		}
	}
}