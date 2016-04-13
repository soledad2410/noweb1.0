<section>
<!-- page start-->
    <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading tab-bg-dark-navy-blue wht-color ">
                           Danh sách nhóm thành viên hệ thống
                          </header>
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>Tên Nhóm</th>
                                  <th>Mô tả</th>
                                  <th>Ngày khởi tạo</th>
                                  <td>#</td>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($groups as $item)
                              <tr>
                                  <td><a href="#">{{$item->name}}</a></td>
                                  <td class="hidden-phone">{{$item->description}}</td>
                                  <td>{{date('H:i d-m-Y', strtotime($item->created_at))}}</td>
                                  <td>
                                  @if(is_null($item->active))
                                      <button title="Chưa kích hoạt" class="btn btn-fall btn-xs"><i class="icon-ok"></i></button>
                                  @elseif($item->active == 0)
                                     <button title="Tạm khóa" class="btn btn-warning btn-xs"><i class="icon-ok"></i></button>
                                  @else
                                       <button title="Đang hoạt động" class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                  @endif
                                  @if($item->id != $user->id)
                                      <button onclick="editGroup('{{$item->id}}')" class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button onclick="deleteGroup('{{$item->id}}')" class="btn btn-danger btn-xs"><i class="icon-trash"></i></button>
                                  @endif
                                  </td>
                              </tr>
                              @endforeach
                          </table>
                      </section>
                  </div>

    <div class="col-lg-12">
             <section class="panel">
                                       <header class="panel-heading tab-bg-dark-navy-blue tab-right ">
                                           <ul class="nav nav-tabs pull-right">
                                               <li class="active">
                                                   <a href="#home-3" data-toggle="tab">
                                                      <i class="icon-home"></i>
                                                     Thông tin cần thiết
                                                   </a>
                                               </li>
                                               <li class="">
                                                   <a href="#about-3" data-toggle="tab">
                                                       <i class="icon-user"></i>
                                                      Phân quyền nhóm
                                                   </a>
                                               </li>
                                           </ul>
                                           <span class="hidden-sm wht-color">Thêm mới nhóm thành viên hệ thống</span>
                                       </header>
                                       <form method="post" class="form-horizontal tasi-form" id="create-group">
                                       <div class="panel-body">
                                           <div class="tab-content">
                                               <div class="tab-pane active" id="home-3">
                                                   <section class="panel">
                                                   <div class="panel-body">
                                                         <div class="form-group">
                                                                                         <label for="name" class="col-sm-2 control-label col-lg-2">Tên nhóm</label>
                                                                                         <div class="col-lg-6">
                                                                                             <input type="text" name="name"  class="form-control" required="">
                                                                                         </div>
                                                                                     </div>
                                                         <div class="form-group">
                                                                                         <label for="description" class="col-sm-2 control-label col-lg-2">Mô tả</label>
                                                                                         <div class="col-lg-6">
                                                                                             <textarea name="description" class="form-control" ></textarea>
                                                                                         </div>
                                                                                     </div>
                                                         <div class="form-group">
                                                                                         <label for="re_password" class="col-sm-2 control-label col-lg-2">Kích hoạt</label>
                                                                                         <div class="col-lg-6">
                                                                                             <input type="checkbox" name="active"  class="checkbox form-control" style="width: 10px" value="1">
                                                                                         </div>
                                                                                      </div>
                                                   </div>
                                                   </section>
                                               </div>
                                               <div class="tab-pane" id="about-3">
                                                   <section class="panel">
                                                         <div class="panel-body">
                                                            @foreach($acls as $key => $module)
                                                            <div class="form-group">
                                                              <label for="name" class="col-sm-2 checkbox-inline col-lg-4">
                                                              {{$module['title']}}<input class="checkbox parent" rel="{{$key}}"  type="checkbox" />
                                                              </label>
                                                              <div class="col-lg-6 checkboxes">
                                                                            @foreach($module as $name=> $item)
                                                                                @if(is_array($item) && $item['allows'] == '')
                                                                                <div class="checkbox">
                                                                                    <label class="label_check c_on"><input class="m-bot15 children" rel="{{$key}}" type="checkbox" name="privileges[]" value="{{$key.'@'.$name}}"/>{{$item['title']}}</label>
                                                                                 </div>
                                                                                @endif
                                                                            @endforeach
                                                               </div>
                                                            </div>
                                                            @endforeach
                                                         </div>
                                                   </section>
                                               </div>
                                               <div class="col-lg-2"></div>
                                               <div class="col-lg-10">
                                              <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                                              <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                                               </div>
                                           </div>
                                       </div>
                                        </form>
                                   </section>

               </div>

<!-- page end-->
</section>
<script type="text/javascript" src="{{$resources_path}}/js/user.js"></script>