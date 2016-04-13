<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 17/12/2014
 * Time: 10:08 SA
 */

namespace Noweb\Cp;
use \Noweb\Cp\Group;
use \Noweb\Cp\User;

class AdminController extends BaseController {

	public function index() {

		$currentPage = intval(\Input::get('page')) ? intval(\Input::get('page')) : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 20;
		$offset = ($currentPage - 1) * $limit;
		$total = User::with(['group' => function ($query) {
			$query->select('id', 'name');
		}])->count();
		$users = User::with(['group' => function ($query) {
			$query->select('id', 'name');
		}])->orderby('created_at', 'desc')->take($limit)->skip($offset)->get();
		$paginator = new \Noweb\Cp\Paginator\Paginator($total, $limit, null, 5);
		$groups = Group::all();

		$this->layout->meta = ['title' => 'Quản trị thành viên hệ thống'];
		$this->layout->content = \View::make($this->default_view)
			->with([
				'groups' => $groups,
				'users' => $users,
				'paginator' => $paginator->generatePaginator(),
				'range' => $paginator->getResultRange(),
			]);
	}

	public function createUser() {
		$user = new User();
		$user->bindData(\Input::all());
		$validator = \Validator::make(\Input::all(), array(
			'password' => 'required|min:6',
			're_password' => 'required|same:password',
			'phone' => 'required|min:10|unique:users',
			'email' => 'required|email|unique:users',
			'username' => 'required|min:6|unique:users',
			'group_id' => 'required',
		));
		if ($validator->fails()) {
			return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
		} else {
			$user->password = \Hash::make($user->password);

			if ($user->save()) {
				return \Response::json(['code' => 'success', 'msg' => "Cập nhật thông tin thành công"]);
			}
		}
	}

	public function deleteUser() {
		$id = intval(\Input::get('id'));
		if ($id) {
			if ($id == \Auth::user()->getAuthIdentifier()) {
				return \Response::json(['code' => 'error', 'msg' => 'Không thấy tài khoản hiện hành']);
			}
			$user = User::find($id);
			if (!$user) {
				return \Response::json(['code' => 'error', 'msg' => 'Tài khoản không tồn tại hoặc đã bị xóa']);
			}
			if ($user->deleteUser()) {
				return \Response::json(['code' => 'success', 'msg' => 'Xóa thông tin thành viên thành công']);
			}
		}
	}

	public function editUser($id = null) {
		if ($id) {
			$user = User::find($id);
			if (!$user) {
				return \Redirect::route('cp-404');
			}
			if ($id == \Auth::user()->getAuthIdentifier()) {
				return \Redirect::route('cp-403');
			}
			/** Edit user post */
			$this->layout->meta = ['title' => 'Sửa thông tin cá nhân tài khoản' . $user->username];
			$this->layout->content = \View::make($this->default_view)
				->with([
					'item' => $user,
					'groups' => Group::all(),
				]);
		} else {
			$user = User::find(\Input::get('id'));
			$validator = \Validator::make(\Input::all(), array(
				'phone' => 'unique:users,phone,' . $user->phone . ',phone',
				'group_id' => 'required',
			));
			$user->bindData(\Input::all());
			if (\Input::has('password')) {
				$validator = \Validator::make(\Input::all(), array(
					'password' => 'required|min:6',
					're_password' => 'required|same:password',
				));
				$user->password = \Hash::make($user->password);
			}
			if (!\Input::has('password')) {
				$user->active = \Input::has('active') ? \Input::has('active') : 0;
			}
			if ($validator->fails()) {
				return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
			} else {
				if ($user->save()) {
					return \Response::json(['code' => 'success', 'msg' => "Cập nhật thông tin thành viên thành công"]);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy xa, cập nhật thông tin thất bại']);
				}

			}
		}
	}

	public function group() {
		$this->layout->meta = ['title' => 'Quản lý nhóm thành viên'];
		$groups = Group::all();
		$acls = \Config::get('cp::acl.modules');

		/* Create group */
		if (\Input::has('name')) {
			$validator = \Validator::make(\Input::all(), array(
				'name' => 'unique:groups|min:4',
			));
			if ($validator->fails()) {
				return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
			} else {
				$group = new Group();
				$group->bindData(\Input::all());
				if (\Input::has('privileges')) {
					$group->privileges = implode('|', \Input::get('privileges'));
				}
				if ($group->save()) {
					return \Response::json(['code' => 'success', 'msg' => "Thêm mới nhóm thành viên thành công"]);
				} else {
					return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
				}

			}
		}
		$this->layout->content = \View::make($this->default_view)
			->with(['groups' => $groups, 'acls' => $acls]);
	}

	public function deleteGroup() {
		$id = intval(\Input::get('id'));
		/** Check user */
		if ($id) {
			/** Check group has no member */
			$total = User::where('group_id', '=', $id)->count();
			if ($total > 0) {
				return \Response::json(['code' => 'error', 'msg' => 'Không thể xóa nhóm tài khoản Đang chứa thành viên']);
			}
			$group = Group::find($id);
			if (!$group) {
				return \Response::json(['code' => 'error', 'msg' => 'Nhóm tài khoản không tồn tại hoặc đã bị xóa']);
			}
			if ($group->deleteGroup()) {
				return \Response::json(['code' => 'success', 'msg' => 'Xóa thông tin nhóm thành viên thành công']);
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thông tin thất bại']);
			}
		}
	}

	public function editGroup($id = null) {
		if ($id) {
			/** Generate edit page */
			$group = Group::find($id);
			if (!$group) {
				return \Redirect::route('cp-404');
			}
			$this->layout->meta = ['title' => 'Sửa thông tin nhóm tài khoản ' . $group->name];
			$this->layout->content = \View::make($this->default_view)
				->with(['group' => $group,
					'acls' => \Config::get('cp::acl.modules'),
				]);

		} else {
			/** Post edit info */
			if (\Input::has('id')) {
				$id = \Input::get('id');
				$group = Group::find($id);

				if (!$group) {
					return \Response::json(['code' => 'error', 'msg' => 'Nhóm tài khoản không tồn tại hoặc đã bị xóa']);
				}

				$validator = \Validator::make(\Input::all(), array(
					'name' => 'unique:groups,name,' . $group->name . ',name',
				));
				$group->bindData(\Input::all());
				if ($validator->fails()) {
					return \Response::json(['code' => 'error', 'errors' => $validator->messages()]);
				}
				if (\Input::has('privileges')) {
					$group->privileges = implode('|', \Input::get('privileges'));
				}
				$group->active = \Input::has('active') ? 1 : 0;
				if ($group->save()) {
					return \Response::json(['code' => 'success', 'msg' => 'Cập nhật thông tin nhóm thành viên thành công']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, Cập nhật thông tin thất bại']);
			}
		}
	}
}