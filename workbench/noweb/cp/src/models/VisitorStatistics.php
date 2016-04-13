<?php

namespace Noweb\Cp;

class VisitorStatistics extends BaseModel {

	protected $table = 'visitor_statistics';

	/*  Api process */
	public static function api($action) {

		switch ($action) {
			case 'get':
				$time = \Input::get('time');

				switch ($time) {
				case 'this_week':
						$day = strtotime("+1 day");
						$start_week = strtotime("last sunday midnight", $day);
						$end_week = strtotime("next sunday", $start_week);
						$start = date('Y-m-d H:j:s', $start_week);
						$end = date('Y-m-d H:j:s', $end_week);
						break;
				case 'last_week':
						$day = strtotime("-1 week +1 day");
						$start_week = strtotime("last sunday midnight", $day);
						$end_week = strtotime("next sunday", $start_week);
						$start = date('Y-m-d H:j:s', $start_week);
						$end = date('Y-m-d H:j:s', $end_week);
						break;
				case 'this_month':
						$day = strtotime("+1 day");
						$start_month = strtotime("first day of this month", $day);
						$end_month = strtotime("last day of this month", $day);
						$start = date('Y-m-d H:j:s', $start_month);
						$end = date('Y-m-d H:j:s', $end_month);
						break;
				case 'last_month':
						$day = strtotime("+1 day -1 month");
						$start_month = strtotime("first day of this month", $day);
						$end_month = strtotime("last day of this month", $day);
						$start = date('Y-m-d H:j:s', $start_month);
						$end = date('Y-m-d H:j:s', $end_month);
						break;
				default:
						$start = '0000-00-00 00:00:00';
						$end = '9999-99-99 99:99:99';
						break;
				}

				if ($end > date('Y-m-d H:j:s')) {
					$end = date('Y-m-d H:j:s', time());
				}
				$data['visitors'] = array();

				$v_mobile = VisitorStatistics::where('agent', '=', 'mobile')
					->where('created_at', '>=', $start)
					->where('created_at', '<=', $end)
					->orderby('created_at', 'ASC')
					->get([
						'day AS mobile_num',
						\DB::raw('DATE(created_at) AS day'),
					]);
				// return $v_mobile;
				$v_web = VisitorStatistics::where('agent', '=', 'web')
					->where('created_at', '>=', $start)
					->where('created_at', '<=', $end)
					->orderby('created_at', 'ASC')
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
				// return $queries = \DB::getQueryLog();
				return array_values($data['visitors']);
				break;

			default:
				# code...
				break;
		}
	}
}