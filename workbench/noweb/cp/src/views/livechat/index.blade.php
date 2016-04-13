<link href="{{$resources_path}}/pandachat/admincp/css/style.css" rel="stylesheet">

<div class="panel panel-default panel-primary panda-container">

  <div class="panel-heading panel-heading-primary">
    <h3 class="panel-title">Phòng hỗ trợ khách hàng

    <div class="pull-right">
        <span title="Fullscreen Supporter Panel" class="glyphicon glyphicon-new-window maximize-chat-panel"></span>
         <span title="Exit Fullscreen Supporter Panel" class="glyphicon glyphicon-log-out minimize-chat-panel"></span>

    </div>
    
    </h3>
  </div>
  <!-- panel content -->
  <div class="panel-body ">
        <!-- Chat wrapper -->
        <div class="row">


        <!-- modal -->
          <div class="modal fade" id="modal-switch-supporter">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Chuyển người hỗ trợ</h4>
                </div>
                <div class="modal-body">

                  <p>
                    <strong>Chọn người hỗ trợ</strong>
                  </p>
                  <select id="list-switch-supporter" class="form-control">
                  <?php 

                  $total=count($spList);

                  $li='';

                  for ($i=0; $i < $total; $i++) { 
                    $li.='<option value="'.$spList[$i]['userid'].'">'.$spList[$i]['username'].' ('.$spList[$i]['fullname'].')</option>';
                  }

                  echo $li;
                  ?>
                    
                  </select>

                </div>
                <div class="modal-footer">
                  <button type="button" id="make-switch-supporter" class="btn btn-primary">Mời người hỗ trợ</button>
                </div>
              </div>
            </div>
          </div>
        <!-- modal -->


            <!-- left -->
            <div class="col-lg-9">
                <!-- Wrapper chat user -->
                <div class="panda-list-box-chat">
                    <!-- title -->
                    <div class="head-title">
                        <span>Box Chat</span>
                    </div>
                    <!-- title -->

                    <!-- list box chat -->
                    <div class="content">
                        <!-- tabs panel -->

                        <!-- tabs panel -->

                    </div>
                    <!-- list box chat -->
       
                </div>
                <!-- Wrapper chat user -->

            </div>
            <!-- left -->
            <!-- right -->
            <div class="col-lg-3">
                <div class="panda-list-user-online">
                    <!-- title -->
                    <div class="head-title"><span>Khách đang chờ</span> <span class="panda-total-user">(<?php echo $totalUser;?>)</span></div>
                    <!-- title -->
                    <!-- content -->
                    <div class="content panda-scrollbar">
           


                    <?php
                    $total=count($userList);

                    $li='';

                    $last5sec=time()-10;

                    if(isset($userList[0]['roomid']))
                    for ($i=0; $i < $total; $i++) { 

                      if(!isset($userList[$i]['fullname']))
                      {
                        continue;
                      }

                      $last_active=strtotime($userList[$i]['last_active']);

                      $dataOnline='yes';

                      if($last5sec > $last_active)
                      {
                        $dataOnline='no';
                      }

                      $li.='
                      <!-- user -->
                      <div class="user user-online-'.$userList[$i]['guestid'].'" data-online="'.$dataOnline.'" data-userid="'.$userList[$i]['guestid'].'" data-guestid="'.$userList[$i]['guestid'].'" data-ip="'.$userList[$i]['ip'].'" id="roomid-'.$userList[$i]['roomid'].'" data-roomid="'.$userList[$i]['roomid'].'" data-fullname="'.$userList[$i]['fullname'].'">
                          <span title="Nói chuyện với '.$userList[$i]['fullname'].'">'.ucfirst($userList[$i]['fullname']).'

                          </span>
                          <span class="user-online-status"><img src="'.ROOT_URL.'bootstrap/pandachat/admincp/images/online.png"></span>
                      </div>
                      <!-- user -->

                      ';
                    }

                    echo $li;

                    ?>


                    </div>
                    <!-- content -->
                </div>
            </div>
            <!-- right -->

        </div>
         <!-- Chat wrapper -->

  </div>
  <!-- panel content -->
</div>

<script type="text/javascript" src="{{$resources_path}}/pandachat/admincp/js/core.js"></script>


<script type="text/javascript">

  var root_url='<?php echo $root_url;?>';

  //var api_url=root_url+'api/';
  var api_url=root_url+'cp/livechat/';

  var totalUser=<?php echo $totalUser;?>;

  var curRoomid=0;

  var curGuestid=0;

  var curSupporterid=<?php echo $_SESSION['userid'];?>;

  var curGuestName='Khách';

  var curSupporterName='<?php echo $_SESSION["fullname"];?>';

  var loadTalk='no';

  var curTalkid=0;


  var timeid=<?php echo time();?>;

document.addEventListener('DOMContentLoaded', function () {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
});

function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
$(document).on("keydown", disableF5);

$(window).bind('beforeunload', function(e) {

    if (1)
    { 
        return "Lưu ý: Không refresh lại page khi đang hỗ trợ khách hàng."
        e.preventDefault();
    }
});

function showDesktopNotification(text)
{


  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Thông báo', {
      icon: '{{$resources_path}}/pandachat/admincp/images/notify.png',
      body: text,
    });


  }
}


function upTime()
{
  timeid=parseInt(timeid)+1;

  setTimeout(function(){ upTime(); },1000);
}

function showTab(showID)
{
    $('#myTabs a[href="#'+showID+'"]').tab('show');
}

function showInputChat()
{
  // $('.panda-input-typechat').show();
}

function hideInputChat()
{
  // $('.panda-input-typechat').hide();
}

function check_room_chat_exists(roomid)
{
  if($('.chat-roomid-'+roomid).length==1)
  {
    $('.panda-room-chat').hide();

    $('.chat-roomid-'+roomid).show();
  }
}

function createRoomToChat(roomid,guestid,fullname)
{
  var curRoomid=roomid;

  var dataroom='';

  dataroom='<div class="panda-room-chat chat-roomid-'+roomid+'" data-guestid="'+guestid+'" data-fullname="'+fullname+'" data-roomid="'+roomid+'">';


  dataroom+='<div class="panda-wrapper-chat panda-scrollbar"></div>';

  dataroom+='<div class="panda-input-group panda-input-typechat">';

  dataroom+='<input type="text" class="panda-form-control" id="panda-chat-to-send" placeholder="Write your question" />';

  dataroom+='<button type="button" id="panda-btn-send-chat" class="btn btn-panda-default">Send</button>';

  dataroom+='</div>';

  dataroom+='<div class="panda-room-chat-footer"><div class="dropup"><button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Thiết lập <span class="caret"></span></button>';

  dataroom+='<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';

   dataroom+='<li><a href="#" data-toggle="modal" data-id="modal-switch-supporter" data-roomid="'+roomid+'" data-guestid="'+guestid+'" class="panda-switch-people-in-room">Đổi người hỗ trợ</a></li>';

  dataroom+='<li><a href="#" class="panda-end-talk-button" data-roomid="'+roomid+'" data-guestid="'+guestid+'" title="Đóng phòng chat">Kết thúc</a></li></ul></div></div>';

 dataroom+='</div>';



  if(document.getElementsByClassName('chat-roomid-'+roomid).length == 0)
  {

  var jq = document.createElement('div');  
  jq.innerHTML=dataroom;  

   var elements= document.querySelector('.panda-list-box-chat .content');

   elements.insertBefore(jq, elements.firstChild);


    document.getElementsByClassName('chat-roomid-'+roomid)[0].style.display='';

  }
  

}

function appendToChat(roomid,data)
{


var jq = document.createElement('div');
jq.innerHTML=data;

  if(jq==null)
  {
    return false;
  }

  var el=document.querySelector('.chat-roomid-'+roomid+' .panda-wrapper-chat');

  if(el==null)
  {
    return false;
  }

  el.appendChild(jq);
  


  scrollOnRoom(roomid);

}

function writeToChat(roomid,data)
{
  $('.chat-roomid-'+roomid).children('.panda-wrapper-chat').html(data);

    scrollOnRoom(roomid);
}

function scrollOnRoom(roomid)
{
  $('.chat-roomid-'+roomid).children('.panda-wrapper-chat').animate({ scrollTop: 5720 }, "fast"); 
}

function makeTime()
{
  var n = new Date().getTime();

  return n;
}

function removeChatLineByTime(time)
{
  $('.chatline-'+time).remove();
}

// Build chat line html format
function makeChatLine(roomid,fullname,dateadded,content)
{

  var chatLine='<div class="panda-row-chat">';
  chatLine+='<span class="people-name">'+fullname+'</span>';
  chatLine+='<span class="people-date-sended pull-right">'+dateadded+'</span>';
  chatLine+='<div class="people-chat-content">'+content+'</div>';
  chatLine+='</div>';

  appendToChat(roomid,chatLine);
}

function makeChatLineWithTime(roomid,fullname,dateadded,content,time)
{

  var chatLine='<div class="panda-row-chat chatline-'+time+'">';
  chatLine+='<span class="people-name">'+fullname+'</span>';
  chatLine+='<span class="people-date-sended pull-right">'+dateadded+'</span>';
  chatLine+='<div class="people-chat-content">'+content+'</div>';
  chatLine+='</div>';

  appendToChat(roomid,chatLine);
}

function makeChatNotify(roomid,keyname,str)
{
  var chatLine='<div class="panda-row-chat">';
  chatLine+='<span class="people-name">'+keyname+'</span>';
  chatLine+='<span class="people-date-sended pull-right"></span>';
  chatLine+='<div class="people-chat-content">'+str+'</div>';
  chatLine+='</div>';

  appendToChat(roomid,chatLine);
}


function addUserToList(data)
{


  console.log('Bắt đầu thêm khách vào danh sách:'+data['fullname']);


  if(data['fullname'].length < 2)
  {
    console.log('Lỗi khi thêm '+data['fullname']+' vào danh sách.');

    return false;
  }


  if($('#roomid-'+data['roomid']).length==1)
  {
    return false;
  }


  curGuestid=data['guestid'];

  var userline='<div class="user user-online-'+data['guestid']+'" data-online="yes" data-userid="'+data['guestid']+'" id="roomid-'+data['roomid']+'" data-roomid="'+data['roomid']+'" data-fullname="'+data['fullname']+'">';
  userline+='<span title="Nói chuyện với '+data['fullname']+'">'+data['fullname']+'</span>';
  userline+='<span class="user-online-status"><img src="{{$resources_path}}/pandachat/admincp/images/online.png"></span>';
  userline+='</div>';

  $('.panda-list-user-online').children('.content').prepend(userline);

  upUserOnline(data['fullname'],data['question']);

  getUserStatus(data['roomid'],curGuestid);
}




function makeUserExitRoom(roomid)
{
  console.log('Đã đóng phòng chat '+roomid);

  makeChatNotify(roomid,'Thông báo','Khách đã thoát khỏi phòng.');


}


function upUserOnline(fullname,question)
{
  console.log(fullname+' online với câu hỏi: '+question);

  showDesktopNotification(fullname+' online với câu hỏi: '+question);

  totalUser=parseInt(totalUser)+1;

  $('.panda-total-user').html('('+totalUser+')');
}

function downUserOnline(roomid)
{
  totalUser=parseInt(totalUser)-1;

  $('.panda-total-user').html('('+totalUser+')');

  $('.user').each(function() {

      var thisroomid=$(this).attr('data-roomid');

      if($(this).attr('data-online')=='yes')
      {
        if(parseInt(thisroomid)==parseInt(roomid))
        {
          send_guest_exit(roomid);

          makeUserExitRoom(roomid);

          console.log('Khách ở phòng '+roomid+' đã thoát.');

          showDesktopNotification('Khách ở phòng '+roomid+' đã thoát.');
         

        }        
      }
      else
      {

        $(this).attr('data-online','no');

        $(this).children('span.user-online-status').html('<img src="{{$resources_path}}/pandachat/admincp/images/offline.png">');
      }



  });



}

function send_guest_exit(theroomid)
{
  console.log('Thực hiện công việc khi khách thoát khỏi phòng');

   $.ajax({
  async: false,
   type: "POST",
   url: api_url+'chatroom-guestexit',
   data: ({
        send_roomid : theroomid
        }),
   dataType: "html",
   error : function(XMLHttpRequest, textStatus, errorThrown){


   },
   success: function(msg)
          {


           }
     });    

}

function after_send_chat(chatdata)
{
  console.log('Phân tích dữ liệu chat');
  console.log(chatdata);

  var totalRow=chatdata.length;

  var thistime=0;

  for(var i=0;i<totalRow;i++)
  {
    var thistime=chatdata[i]['date_addedNumber'];

    if($('.chatline-'+thistime).length == 0)
    {
      makeChatLineWithTime(chatdata[i]['roomid'],chatdata[i]['fullname'],'',chatdata[i]['content'],chatdata[i]['date_addedNumber']);
    }
    
  }
}

function before_send_chat(roomid,guestid,fullname,text)
{
  console.log('Gửi nội dung chat trong phòng '+roomid+' tới '+fullname);

  $('.chat-roomid-'+roomid).children('.panda-input-group').children('#panda-chat-to-send').val('');


  var dateadded=timeid;

  makeChatLineWithTime(roomid,fullname,'',text,dateadded);


  // ------------------------------------------api_url+'widget-status'
    var request = new XMLHttpRequest();
    request.open('POST', api_url+'talk-supporter-insert', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        // Success!
        var msg = JSON.parse(request.responseText);

            console.log('Dữ liệu sau khi gửi nội dung chat');

            // console.log(msg);

            if(msg['error']=='no')
            {

              if(msg['data'].length > 0)
              {
                after_send_chat(msg['data']);
              }
            }
            else
            {
              alert('Có lỗi: '+msg['message']);

              console.log('Có lỗi khi gửi nội dung chat: '+msg['message']);
            }

      } else {
        // We reached our target server, but it returned an error

              console.log('Có lỗi khi gửi nội dung chat: '+request.responseText);

      }
    };

    request.onerror = function() {
      // There was a connection error of some sort

                      console.log('Có lỗi khi gửi nội dung chat: '+request.responseText);
    };

    request.send("send_roomid="+roomid+"&send_guestid="+guestid+"&send_supporterid="+curSupporterid+"&send_message="+text+"&send_dateadded="+dateadded);

  // ----------------------------------------


}


function getWidgetStatus()
{

  // ------------------------------------------------

    var request = new XMLHttpRequest();
    request.open('POST', api_url+'widget-status', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        // Success!
        // var data = JSON.parse(request.responseText);
        var msg = JSON.parse(request.responseText);

            console.log('Tải dữ liệu của khách truy cập mới.');


            if(msg['error']=='no')
            {
              totalRow=msg['data'].length;

              for(var i=0;i<totalRow;i++)
              {
                addUserToList(msg['data'][i]);
              }


            }

            setTimeout(function(){ getWidgetStatus(); },1000);

      } else {
        // We reached our target server, but it returned an error

        setTimeout(function(){ getWidgetStatus(); },1000);

      }
    };

    request.onerror = function() {
      // There was a connection error of some sort

      setTimeout(function(){ getWidgetStatus(); },1000);
    };

    request.send("load_all_guest=yes");

  // ---------------------------------------------
 

}

function getUserStatus(roomid,guestid)
{


  console.log('Bắt đầu tải dữ liệu về khách id: '+guestid);


  if($('.chat-roomid-'+roomid).length > 0)
  {
    loadTalk='yes';
  }

  if($('.user-online-'+guestid).length==0)
  {
    console.log('Không kiểm tra thấy khách id: '+guestid);

    return false;
  }

  console.log('Kiểm tra tình trạng phòng: '+roomid);



  // --------------------------------------------------------------

    var request = new XMLHttpRequest();
    request.open('POST', api_url+'chatroom-gueststatus', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

    request.onload = function() {

             // console.log(request.responseText);     
      if (request.status >= 200 && request.status < 400) {
        // Success!
        var msg = JSON.parse(request.responseText);


            if(msg['error']=='yes')
            {
              console.log('Khách ở phòng '+roomid+' đã thoát.');


              downUserOnline(roomid);

              return false;
            }
            else
            {
              console.log('Khách ở phòng '+roomid+' đang online.');

              if(loadTalk=='yes')
              {

                if(msg['data']!=null)
                {
                  after_send_chat(msg['data']);
                }

              }


            }

            loadTalk='no';

            setTimeout(function(){ getUserStatus(roomid,guestid); },1000);

      } else {
        // We reached our target server, but it returned an error
        console.log('Có lỗi xảy ra với khách ở phòng '+roomid+': '+request.responseText);

        setTimeout(function(){ getUserStatus(roomid,guestid); },1000);
      }
    };

    request.onerror = function() {
      // There was a connection error of some sort
        console.log('Có lỗi xảy ra với khách ở phòng '+roomid+': '+request.responseText);

        setTimeout(function(){ getUserStatus(roomid,guestid); },1000);        
    };

    request.send("send_roomid="+roomid+"&send_loading_talk="+loadTalk+"&send_guestid="+guestid);

  // -----------------------------------



}

function inviteSupporter(roomid,guestid,supporterid)
{

  console.log('Thực hiện join vào phòng');


  // --------------------------------------------------------------

    var request = new XMLHttpRequest();
    request.open('POST', api_url+'chatroom-supporterjoin', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        // Success!
        // var data = JSON.parse(request.responseText);
        var msg = JSON.parse(request.responseText);


            if(msg['error']=='yes')
            {
              
              return false;
            }

            $('#modal-switch-supporter').modal('hide');


      } else {
        // We reached our target server, but it returned an error
            $('#modal-switch-supporter').modal('hide');

      }
    };

    request.onerror = function() {
      // There was a connection error of some sort
            $('#modal-switch-supporter').modal('hide');
     
    };

    request.send("send_roomid="+roomid+"&send_guestid="+guestid+"&send_supporterid="+supporterid);

  // -----------------------------------



}

$( document ).on( "click", "div.user", function() {

   var theroomid=$(this).attr('data-roomid');

   var thedataonline=$(this).attr('data-online');

   // Event check room exists or not
  if($('.chat-roomid-'+theroomid).length==1)
  {
    console.log('Có phòng rồi, bật phòng chat lên');

    $('.panda-room-chat').hide();

    $('.chat-roomid-'+theroomid).show();

    return false;
  }

  console.log('Chưa có phòng, tạo phòng chat');

   var thefullname=$(this).attr('data-fullname');

   curGuestid=$(this).attr('data-userid');

   if(parseInt(curGuestid)==0)
   {
    curGuestid=$(this).attr('data-guestid');   
   }

   curRoomid=theroomid;

   curGuestName=thefullname;

   $(this).attr('disabled',true);
   $(this).addClass('user-active');

// --------------------------------------------------------------------------------

    var request = new XMLHttpRequest();
    request.open('POST', api_url+'chatroom-join', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        // Success!
        // var data = JSON.parse(request.responseText);
        var msg = JSON.parse(request.responseText);

        if(msg['error']=='yes')
        {
          console.log('Có lỗi mở phòng chat với '+thefullname+': '+msg['message']);

          alert(msg['message']);
        }
        else
        {
          console.log('Bắt đầu mở phòng chat với: '+thefullname);

          // console.log(msg);

          if(msg['data']['is_supporter']=='no')
          {
            if(msg['data']['invite']['has']=='no')
            {

                showDesktopNotification('Bạn không có quyền nói chuyện với người này.');

                return false;
            }            
          }


          if(thedataonline=='yes')
          {
           getUserStatus(theroomid,curGuestid);
          }
          
          createRoomToChat(theroomid,curGuestid,thefullname);

          showInputChat();

          // console.log(msg);

          after_send_chat(msg['data']['message']);


        }


      } else {
        // We reached our target server, but it returned an error
        $(this).removeClass('user-active');
           $(this).attr('disabled',false);

        console.log('Có lỗi khi tham gia phòng chat với: '+thefullname+': '+request.responseText);

        alert('Có lỗi:'+textStatus);
      }
    };

    request.onerror = function() {
      // There was a connection error of some sort
        $(this).removeClass('user-active');
           $(this).attr('disabled',false);

        console.log('Có lỗi khi tham gia phòng chat với: '+thefullname+': '+request.responseText);

        alert('Có lỗi:'+textStatus);

    };

    request.send("send_roomid="+theroomid+"&send_supporterid=<?php echo $_SESSION['userid'];?>&send_guestid="+curGuestid+"&send_dataonline="+thedataonline);


// ------------------------------------------------------

}); 

  // Chat event
  $( document ).on( "keydown", "input#panda-chat-to-send", function(e) {
      if(e.keyCode == 13){
        var roomid=$(this).parent().parent().attr('data-roomid');

        var guestid=$(this).parent().parent().attr('data-guestid');


        var txtChat=$(this).val();

          before_send_chat(roomid,guestid,curSupporterName,txtChat);
      }
  }); 
  $( document ).on( "click", "button#panda-btn-send-chat", function() {
        var roomid=$(this).parent().parent().attr('data-roomid');

        var guestid=$(this).parent().parent().attr('data-guestid');


        var txtChat=$(this).parent().children('input[type="text"]').val();

          before_send_chat(roomid,guestid,curSupporterName,txtChat);
  }); 
  $( document ).on( "click", ".panda-end-talk-button", function() {
        if(confirm('Bạn có chắc chắn muốn đóng phòng chat này ?'))
        {
          var guestid=$(this).attr('data-roomid');
          
          $('.user-online-'+guestid).remove();

          $(this).parent().parent().parent().parent().parent().remove();

        }
  }); 
  $( document ).on( "click", ".panda-switch-people-in-room", function() {

        var catchroomid=$(this).attr('data-roomid');
        var catchguestid=$(this).attr('data-guestid');

        $('#modal-switch-supporter').modal('show');

        $('#make-switch-supporter').attr('data-roomid',catchroomid);
        $('#make-switch-supporter').attr('data-guestid',catchguestid);




  }); 

  $( document ).on( "click", "#make-switch-supporter", function() {

        var thisroomid=$(this).attr('data-roomid');
        var thisguestid=$(this).attr('data-guestid');

        var thissupporterid=$('#list-switch-supporter').children('option:selected').val();


        inviteSupporter(thisroomid,thisguestid,thissupporterid);


  }); 


    $(document).ready(function(){

      upTime();

      getWidgetStatus();



     var elements= document.querySelectorAll('.user');

      Array.prototype.forEach.call(elements, function(el, i){


            var roomid=el.getAttribute('data-roomid');
            var guestid=el.getAttribute('data-userid');

            getUserStatus(roomid,guestid);        
      });



    });


</script>
