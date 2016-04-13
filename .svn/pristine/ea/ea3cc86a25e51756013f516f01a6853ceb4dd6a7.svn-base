<!-- page start-->
<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue wht-color ">
        Danh sách thành viên hệ thống
    </header>
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <th>Tên đăng nhập</th>
                <th>Địa chỉ email</th>
                <th>Điện thoại</th>
                <th>Nhóm thành viên</th>
                <th>Tên đầy đủ</th>
                <th>Ngày đăng ký</th>
                <td>#</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $item)
            <tr>
                <td><a href="#">{{$item->username}}</a></td>
                <td class="hidden-phone">{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->group->name}}</td>
                <td>{{$item->fullname}}</td>
                <td>{{date('H:i d-m-Y', strtotime($user->created_at))}}</td>
                <td>
                    @if(is_null($item->active))
                    <button title="Chưa kích hoạt" class="btn btn-fall btn-xs"><i class="icon-remove"></i></button>
                    @elseif($item->active == 0)
                    <button title="Tạm khóa" class="btn btn-warning btn-xs"><i class="icon-remove"></i></button>
                    @else
                    <button title="Đang hoạt động" class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                    @endif
                    @if($item->id != $user->id)
                    <a class="btn btn-xs btn-info" onclick="editUser('{{$item->id}}')" href="javascript:;"><i class="icon-edit"></i></a>
                    <a class="btn btn-xs btn-danger" onclick="deleteUser('{{$item->id}}')" href="javascript:;"><i class="icon-remove"></i></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row"><div class="col-lg-6"><div class="dataTables_info" id="editable-sample_info">Hiển thị kết quả từ {{$range['from']}} tới {{$range['to']}} trên tổng {{$range['totalRecord']}} bản ghi</div></div><div class="col-lg-6"><div class="dataTables_paginate paging_bootstrap pagination">{{$paginator}}</div></div></div>
</section>

<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue tab-right ">
        <ul class="nav nav-tabs pull-right">
            <li class="active">
                <a href="#home-3" data-toggle="tab">
                    <i class="icon-home"></i>
                    Thông tin đăng nhập
                </a>
            </li>
            <li class="">
                <a href="#about-3" data-toggle="tab">
                    <i class="icon-user"></i>
                    Thông tin cá nhân
                </a>
            </li>
        </ul>
        <span class="hidden-sm wht-color">Thêm mới thành viên</span>
    </header>
    <form method="post" class="form-horizontal tasi-form" id="create-user">
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane active" id="home-3">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label col-lg-2">Tên truy cập</label>
                                <div class="col-lg-6">
                                    <input type="text" name="username"  class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label col-lg-2">Địa chỉ email</label>
                                <div class="col-lg-6">
                                    <input type="email" name="email"  class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-sm-2 control-label col-lg-2">Số điện thoại</label>
                                <div class="col-lg-6">
                                    <input type="text" name="phone"  class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fullname" class="col-sm-2 control-label col-lg-2">Tên đầy đủ</label>
                                <div class="col-lg-6">
                                    <input type="text" name="fullname"  class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label col-lg-2">Mật khẩu</label>
                                <div class="col-lg-6">
                                    <input type="password" name="password"  class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="re_password" class="col-sm-2 control-label col-lg-2">Gõ lại mật khẩu</label>
                                <div class="col-lg-6">
                                    <input type="password" name="re_password"  class="form-control" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="re_password" class="col-sm-2 control-label col-lg-2">Nhóm thành viên</label>
                                <div class="col-lg-6">
                                    <select name="group_id" class="form-control m-bot15">
                                        @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
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
                            <div class="form-group">
                                <label for="yahoo" class="col-sm-2 control-label col-lg-2">Yahoo</label>
                                <div class="col-lg-6">
                                    <input type="text" name="yahoo"  class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alias" class="col-sm-2 control-label col-lg-2">Biệt hiệu</label>
                                <div class="col-lg-6">
                                    <input type="text" name="alias"  class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="skype" class="col-sm-2 control-label col-lg-2">Skype</label>
                                <div class="col-lg-6">
                                    <input type="email" name="skype"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="facebook" class="col-sm-2 control-label col-lg-2">Facebook</label>
                                <div class="col-lg-6">
                                    <input type="text" name="facebook"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="twitter" class="col-sm-2 control-label col-lg-2">Twitter</label>
                                <div class="col-lg-6">
                                    <input type="text" name="twitter"  class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label col-lg-2">Địa chỉ</label>
                                <div class="col-lg-6">
                                    <input type="text" name="address"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="about" class="col-sm-2 control-label col-lg-2">Ghi chú</label>
                                <div class="col-lg-6">
                                    <textarea class="form-control" name="about">
                                    </textarea>
                                </div>
                            </div>
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

<!-- page end-->

<script type="text/javascript" src="{{$resources_path}}/js/user.js"></script>