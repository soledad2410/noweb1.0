<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 17/12/2014
 * Time: 10:08 SA
 */

namespace Noweb\Cp;
use \Noweb\Cp\Contact;
use \Noweb\Cp\Paginator\Paginator;

class ContactController extends BaseController {

	public function index() {

		$currentPage = intval(\Input::get('page')) ? intval(\Input::get('page')) : 1;
		$limit = intval(\Input::get('per-page')) ? intval(\Input::get('per-page')) : 10;
		$offset = ($currentPage - 1) * $limit;

		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'created_at';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'DESC';

		$contacts = Contact::leftJoin('departments', 'contacts.department_id', '=', 'departments.id')
			->orderby($sortBy, $sort)
			->skip($offset)
			->take($limit)
			->get([
				'contacts.*',
				'departments.*',
				'contacts.id AS id',
			]);
		$total = Contact::leftJoin('departments', 'contacts.department_id', '=', 'departments.id')->get()->count();
		$paginator = new Paginator($total, $limit, null, null, 5);

		$this->layout->meta = ['title' => 'Quản trị liên hệ website'];
		$this->layout->content = \View::make($this->default_view)->with(
			[
				'contacts' => $contacts,
				'paginator' => $paginator->generatePaginator(),
				'range' => $paginator->getResultRange(),
			]
		);
	}

	public function get($id) {
		if (intval($id) > 0) {
			$contact = Contact::leftJoin('departments', 'contacts.department_id', '=', 'departments.id')
				->where('contacts.id', '=', $id)->get()[0];
			if (!empty($contact)) {
				return \Response::json($contact->toArray());
			} else {
				return \Response::json(['code' => 'error', 'msg' => 'Liên hệ không tồn tại hoặc đã bị xóa']);
			}
		}
	}

	public function edit($id) {
		$status = \Input::get('status');
		if (\DB::table('contacts')->where('id', '=', $id)->update(['contact_status' => $status])) {
			return \Response::json(['code' => 'success']);
		}
		return \Response::json(['code' => 'error']);
	}

	public function delete() {
		$id = \Input::get('id');
		if (!is_array($id)) {
			$contact = Contact::find($id);
			if ($contact) {
				if ($contact->deleteContact($id)) {
					return \Response::json(['code' => 'success']);
				}
				return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thất bại']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Liên hệ không tồn tại hoặc đã bị xóa']);
		} else {
			$contact = new Contact();
			if ($contact->deleteContact($id)) {
				return \Response::json(['code' => 'success']);
			}
			return \Response::json(['code' => 'error', 'msg' => 'Có lỗi xảy ra, xóa thất bại']);
		}
	}

	public function getNew() {
		$count = Contact::where('contact_status', '=', 0)->get()->count();
		$contacts = Contact::where('contact_status', '=', 0)
			->orderby('created_at', 'DESC')
			->take(5)
			->get();
		return \Response::json(['contacts' => $contacts, 'count' => $count]);
	}
}