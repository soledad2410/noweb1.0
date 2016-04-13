<section class="wrapper">
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
                              <h1>Lịch sử truy cập</h1>
                              <div class="row">
                            <div class="col-lg-12">
                                                  <section class="panel">
                            <div class="row"><div class="col-lg-6"><div id="editable-sample_length" class="dataTables_length"><label><select name="editable-sample_length" size="1" aria-controls="editable-sample" class="form-control xsmall"><option value="5" selected="selected">5</option><option value="15">15</option><option value="20">20</option><option value="-1">All</option></select> records per page</label></div></div><div class="col-lg-6"><div class="dataTables_filter" id="editable-sample_filter"><label>Search: <input type="text" aria-controls="editable-sample" class="form-control medium"></label></div></div></div>
                                                      <table class="table table-striped table-advance table-hover">
                                                          <thead>
                                                          <tr>
                                                              <th>Ngày tháng</th>
                                                              <th>IP</th>
                                                              <th>Nền tảng</th>
                                                          </tr>
                                                          </thead>
                                                          <tbody>
                                                          @foreach($items as $item)
                                                          <tr>
                                                              <td><a href="javascript:void(0)">{{date('H:i:s d-m-Y',strtotime($item->logged_time))}}</a></td>
                                                              <td class="hidden-phone">{{$item->ip_address}}</td>
                                                              <td>{{$item->platform}}</td>
                                                          </tr>
                                                          @endforeach
                                                          </tbody>
                                                      </table>
                                                      <div class="row"><div class="col-lg-6"><div class="dataTables_info" id="editable-sample_info">Hiển thị kết quả từ {{$range['from']}} tới {{$range['to']}} trên tổng {{$range['totalRecord']}} bản ghi</div></div><div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination">{{$paginator}}</div></div></div>
                                                  </section>
                                              </div>
                                   </div>
                              </div>
                      </section>
                  </aside>
              </div>
              <!-- page end-->
          </section>