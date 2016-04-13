          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                               <aside class="profile-nav col-lg-3">
                                     <section class="panel">
                                         <div class="user-heading round">
                                             <a href="#" class="user-avatar" id="user-avatar-thumb">
                                                 <img src="{{$user->getAvatar()}}" alt="">
                                             </a>

                                             <h1>{{$user->username}}</h1>
                                             <p>{{$user->email}}</p>
                                               <button class="btn btn-primary btn-xs get-avatar"><i class="icon-pencil"></i></button>
                                               <button class="btn btn-success btn-xs submit-avatar"><i class="icon-ok"></i></button>
                                               <input type="hidden" name="avatar" id="user-avatar" value="{{$user->avatar}}"/>

                                         </div>
                                         <ul class="nav nav-pills nav-stacked">
                                             <li class="{{$current_module['module'].'/'.$current_module['action'] == 'profile/index' ? 'active' : '';}}"><a href="/cp/profile"> <i class="icon-user"></i> Profile</a></li>
                                             <li class="{{$current_module['module'].'/'.$current_module['action'] == 'profile/activities' ? 'active' : '';}}"><a  href="/cp/profile/activities"> <i class="icon-calendar"></i> Lịch sử truy cập </a></li>
                                             <li class="{{$current_module['module'].'/'.$current_module['action'] == 'profile/edit' ? 'active' : '';}}"><a  href="/cp/profile/edit"> <i class="icon-edit"></i> Sửa profile</a></li>
                                         </ul>
                                     </section>
                                 </aside>
                  <aside class="profile-info col-lg-9">
                      <section class="panel">
                          <div class="panel-body bio-graph-info">
                              <h1> Profile Info</h1>
                              <form role="form" class="form-horizontal profile-form cmxform" method="post">
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">About Me</label>
                                      <div class="col-lg-10">
                                          <textarea rows="10" cols="30" class="form-control"  name="about">{{$user->about}}</textarea>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Tên đầy đủ</label>
                                      <div class="col-lg-6">
                                          <input type="text" name="fullname" value="{{$user->fullname}}"  class="form-control" required="" >
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Địa chỉ email</label>
                                      <div class="col-lg-6">
                                          <input type="text" placeholder=" " value="{{$user->email}}" disabled="" name="email" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Mobile</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="{{$user->phone}}" placeholder=" " name="phone"  class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-lg-2 control-label">Điện thoại cố định</label>
                                      <div class="col-lg-6">
                                          <input type="text" value="{{$user->home_phone}}" placeholder=" " name="home_phone" class="form-control">
                                      </div>
                                  </div>
                                <div class="form-group">
                                      <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                                              <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </section>
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading">Thông tin liên lạc khác</div>
                              <div class="panel-body">
                                  <form role="form" class="form-horizontal profile-form cmxform" method="post" action="/cp/profile/edit">
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Biệt hiệu</label>
                                          <div class="col-lg-6">
                                              <input type="text" placeholder=" " name="alias" value="{{$user->alias}}"  class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Yahoo</label>
                                          <div class="col-lg-6">
                                              <input type="text" placeholder=" " name="yahoo" value="{{$user->yahoo}}" class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Skype</label>
                                          <div class="col-lg-6">
                                              <input type="text" placeholder=" " name="skype" value="{{$user->skype}}"  class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Twitter</label>
                                          <div class="col-lg-6">
                                              <input type="text" placeholder=" " name="twitter" value="{{$user->twitter}}"  class="form-control">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Facebook</label>
                                          <div class="col-lg-6">
                                              <input type="text" placeholder=" " name="facebook" value="{{$user->facebook}}"  class="form-control">
                                          </div>
                                      </div>
                                         <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                                              <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                      <section>
                          <div class="panel panel-primary">
                              <div class="panel-heading"> Thay đổi mật khẩu</div>
                              <div class="panel-body">
                                  <form role="form" class="form-horizontal profile-form cmxform"  method="post" action="/cp/profile/edit">
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Current Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" name="old_password" placeholder=" "  class="form-control" required="">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">New Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" name="new_password" placeholder=" "  class="form-control" required="">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label class="col-lg-2 control-label">Re-type New Password</label>
                                          <div class="col-lg-6">
                                              <input type="password" name="re_password" placeholder=" "  class="form-control" required="">
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                                              <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
                  </aside>
              </div>
              <!-- page end-->
          </section>

    <script type="text/javascript" src="{{$resources_path}}/js/user.js"></script>