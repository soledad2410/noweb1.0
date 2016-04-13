<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 14/01/2015
 * Time: 2:20 CH
 */

namespace Noweb\Cp;
// use \Noweb\Cp\Category;
use \Noweb\Cp\DomainService;

use \Noweb\Cp\Livechat;
use \Noweb\Cp\LivechatRoom;

use \Noweb\Cp\LivechatContacts;
use \Noweb\Cp\User;

class LivechatController extends BaseController {

	public function index($type = false) {
		$this->layout->meta = ['title' => 'Trang hỗ trợ khách hàng'];


		$domain = new DomainService();
		$sortBy = \Input::has('sortBy') ? \Input::get('sortBy') : 'order_num';
		$sort = \Input::has('sort') ? \Input::get('sort') : 'ASC';

		$username=$_SESSION['ck']['user'];

		$userData=User::select('username','fullname',\DB::raw('id as userid'))->where('username','=',$username)->get();

		$_SESSION['username']=$userData[0]->username;
		$_SESSION['fullname']=$userData[0]->fullname;
		$_SESSION['userid']=$userData[0]->userid;

		$today=date('Y-m-d 00:00:00',time()-84600);

		$thistime=date('Y-m-d H:i:s');


		$spList= LivechatRoom::leftJoin('livechat_guest','livechat_room.guestid','=','livechat_guest.guestid')
								->whereBetween('livechat_room.date_added',array($today,$thistime))
								->orderBy('livechat_room.roomid','DESC')
								->get();

		$userList=\DB::table('users')->select('username','fullname',\DB::raw('id as userid'))->orderBy('username','ASC')->get();

		$userList = json_decode(json_encode($userList), true);
		// $userList=\DB::select("select username,fullname from users order by username asc");

		
		$this->layout->content=\View::make($this->default_view)->with([
			'spList'=>$spList,
			'totalUser'=>count($spList),
			'userList'=>$userList,
			'root_url'=>url().'/'
			]);
	}

	public function chatroom_join()
	{
		$result=array('error'=>'yes','message'=>'','invite'=>array('roomid'=>0));

		$roomid=\Input::get('send_roomid','0');

		$supporterid=\Input::get('send_supporterid','0');

		$guestid=\Input::get('send_guestid','0');

		$send_dataonline=\Input::get('send_dataonline','0');

		if((int)$roomid==0 || (int)$supporterid==0 || (int)$guestid==0 )
		{
			$result['message']='Data not valid';

			return json_encode($result);
		}		

		$thistime=date('Y-m-d H:i:s');

		$userid=$_SESSION['userid'];		

		if($send_dataonline=='yes')
		{
			
			$checkExists=LivechatRoom::where('roomid','=',$roomid)->where(function($query){
				$query->where('supporterid','=','0')->orWhere('supporterid','=',$_SESSION['userid']);
			})->get();

			$checkExists=json_decode(json_encode($checkExists),true);

			$result['is_supporter']='no';

			$result['invite']['has']='no';

			if(!isset($checkExists[0]['roomid']))
			{
				// $loadInvite=LiveChatInvite::get(array(
				// 	'where'=>"where roomid='$roomid'"
				// 	));

				$loadInvite=LivechatInvite::where('roomid','=',$roomid)->get();

				$loadInvite=json_decode(json_encode($loadInvite),true);

				$result['invite']=$loadInvite[0];
				
				$result['invite']['has']='no';

				if(isset($loadInvite[0]['roomid']))
				{
					$result['invite']['has']='yes';
				}
							
			}
			else
			{
				$result['invite']['has']='no';
				$result['is_supporter']='yes';

				$updateData=array(
					'supporterid'=>$supporterid,
					'supporter_active'=>$thistime
					);

				LivechatRoom::update();

				\DB::update("update livechat_room set supporterid=?,supporter_active=? where roomid=?",array($supporterid,$thistime,$roomid));


				if(!isset($_SESSION['roomlist']))
				{
					$_SESSION['roomlist']=array();
				}

				if(!in_array($roomid, $_SESSION['roomlist']))
				{
					$_SESSION['roomlist'][]=$roomid;
				}					
			}
		
		}		

		return $result;

	}

	public function chatroom_supporterjoin()
	{
		$result=array('error'=>'no','message'=>'');

		$send_roomid=\Input::get('send_roomid','0');

		$send_guestid=\Input::get('send_guestid','0');

		$send_supporterid=\Input::get('send_supporterid','0');

		$insertData=array(
			'userid'=>$send_supporterid,
			'roomid'=>$send_roomid
			);

		LivechatInvite::insert($insertData);
				
		return $result;
	}

	public function chatroom_gueststatus()
	{
		$result=array('error'=>'no','message'=>'');

		$roomid=\Input::get('send_roomid','0');
		$guestid=\Input::get('send_guestid','0');

		$send_loading_talk=\Input::get('send_loading_talk','no');

		if((int)$roomid==0)
		{
			$result['error']='yes';
			$result['message']='Error Processing Request';

			return $result;
		}

		$last1sec=date('Y-m-d H:i:s',time()-10);

		$thistime=date('Y-m-d H:i:s');

		$last2sec=date('Y-m-d H:i:s',time()-10);

		$loadData=LiveChatRoom::get(array(
			'query'=>"select r.roomid from livechat_room r left join livechat_guest g ON r.guestid=g.guestid WHERE r.roomid='$roomid' AND g.last_active >= '$last1sec'"
			));

		LiveChatRoom::update($roomid,array(
			'supporter_active'=>$thistime
			));

		$loadData=LivechatRoom::leftJoin('livechat_guest','livechat_guest.guestid','=','livechat_room.guestid')
								->where('livechat_room.roomid','=',$roomid)
								->where('livechat_guest.last_active','>=',$last1sec)
								->get();

		$loadData=json_decode(json_encode($loadData),true);

		if(!isset($loadData[0]['roomid']))
		{
			// LiveChatRoom::removeSession($roomid);
			
			// throw new Exception("Guest have been exit.");
		}

		if($send_loading_talk=='yes')
		{
			

			$loadData=LiveChatTalk::get(array(
				'query'=>"select g.fullname,t.* from livechat_guest g left join livechat_talk t ON t.guestid=t.guestid WHERE t.roomid='$roomid' group by t.talkid order by t.talkid asc"
				));

			$loadData=LivechatTalk::leftJoin('livechat_guest','livechat_guest.guestid','=','livechat_talk.guestid');

			$useridList=array();

			if(isset($loadData[0]['talkid']))
			{
				$total=count($loadData);

				for ($i=0; $i < $total; $i++) { 
					$userid=$loadData[$i]['supporterid'];

					$useridList[$userid]='yes';

					$loadData[$i]['content']=$loadData[$i]['message'];
				}

				$uTotal=count($useridList);

				if($uTotal > 0)
				{
					$uList="'".implode("','", array_keys($useridList))."'";

					$loadUser=Users::get(array(
						'where'=>"where userid IN ($uList)"
						));		
						
					$totalU=count($loadUser);

					for ($i=0; $i < $totalU; $i++) { 
						for ($j=0; $j < $total; $j++) { 
							if((int)$loadUser[$i]['userid']==(int)$loadData[$j]['peopleid'])
							{
								$loadData[$j]['fullname']=$loadUser[$i]['firstname'].' '.$loadUser[$i]['lastname'];
							}
						}
					}


				}




			}
			

			return $loadData;

		}


		return $result;
	}

	public function chatroom_guestexit()
	{
		return 'ok guest exit';
	}

	public function widget_status()
	{
		return 'ok wid stt';
	}
	public function talk_supporter_insert()
	{
		return 'ok sp insert stt';
	}

}