
              <!-- page start-->
              <div class="row">
                  <aside class="profile-nav col-lg-3">
                      <section class="panel">
                          <div class="user-heading round">
                              <a href="#">
                                  <img src="{{$user->getAvatar()}}" alt="">
                              </a>
                              <h1>{{$user->username}}</h1>
                              <p>{{$user->email}}</p>
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
                              <h1>Thông tin cá nhân</h1>
                              <div class="row">
                                  <div class="bio-row">
                                      <p><span>Tên truy cập </span>: {{$user->username}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Tên đầy đủ </span>: {{$user->fullname}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Tỉnh/Thành phố </span>: {{ $user->city->name or '';}} </p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Quận/huyện</span>: {{$user->district->name or '';}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Email </span>: {{$user->email}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Mobile </span>: {{$user->phone}}</p>
                                  </div>
                                  <div class="bio-row">
                                      <p><span>Phone </span>: {{$user->homephone}}</p>
                                  </div>
                                    <div class="bio-row">
                                      <p><span>Địa chỉ </span>: {{$user->address}}</p>
                                  </div>
                                    <div class="bio-row">
                                      <p><span>Biệt hiệu </span>: {{$user->alias}}</p>
                                  </div>
                                    <div class="bio-row">
                                      <p><span>Ngày sinh</span>: {{date('d-m-Y',strtotime($user->birthdate))}}</p>
                                  </div>
                                   </div>
                              </div>
                      </section>
                  </aside>
              </div>
              <!-- page end-->

<script type="text/javascript" src="{{$resources_path}}/js/user.js"></script>