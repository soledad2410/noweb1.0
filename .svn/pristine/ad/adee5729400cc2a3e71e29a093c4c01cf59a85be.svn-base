<section>
    <!-- page start-->
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue tab-right ">
                <ul class="nav nav-tabs pull-left">
                    <li class="">
                        <a href="/cp/admin"><i class="icon-reorder"></i> Danh sách thành viên hệ thống</a>
                    </li>
                    <li class="active">
                        <a href="javascript:;"><i class="icon-pencil"></i> Sửa thông tin người dùng
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-tabs pull-right">
                    <li class="active">
                        <a data-toggle="tab" href="#home-3">
                            <i class="icon-home"></i>
                            Thông tin đăng nhập
                        </a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#about-3">
                            <i class="icon-user"></i>
                            Thông tin cá nhân
                        </a>
                    </li>
                </ul>
            </header>
            <form id="edit-user" class="form-horizontal tasi-form edit-user" method="post">
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="home-3" class="tab-pane active">
                            <section class="panel">
                                <div class="panel-body">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="username">Tên truy cập</label>
                                        <div class="col-lg-6">
                                            <input type="text" required="" class="form-control" value="{{$item->username}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="email">Địa chỉ email</label>
                                        <div class="col-lg-6">
                                            <input type="text" required="" class="form-control"  value="{{$item->email}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="phone">Số điện thoại</label>
                                        <div class="col-lg-6">
                                            <input type="text" required="" class="form-control" name="phone" value="{{$item->phone}}" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="fullname">Tên đầy đủ</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="fullname" value="{{$item->fullname}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="re_password">Nhóm thành viên</label>
                                        <div class="col-lg-6">
                                            <select name="group_id" class="form-control m-bot15" data-value="{{$item->group_id}}">
                                                @foreach($groups as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="re_password">Kích hoạt</label>
                                        <div class="col-lg-6">
                                            <input type="checkbox" value="1" style="width: 10px" class="checkbox form-control" name="active" data-value="{{$item->active}}">
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div id="about-3" class="tab-pane">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="yahoo">Yahoo</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="yahoo" value="{{$item->yahoo}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="alias">Biệt hiệu</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="alias" value="{{$item->alias}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="skype">Skype</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="skype" value="{{$item->skype}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="facebook">Facebook</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="facebook" value="{{$item->facebook}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="twitter">Twitter</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="twitter" value="{{$item->twitter}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="address">Địa chỉ</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="address" value="{{$item->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="about">Ghi chú</label>
                                        <div class="col-lg-6">
                                            <textarea name="about" class="form-control">{{$item->about}}</textarea>
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
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue tab-right ">
                <span class="hidden-sm wht-color">Sửa mật khẩu tài khoản thành viên</span>
            </header>
            <form id="edit-user-password" class="form-horizontal tasi-form edit-user" method="post">
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="home-3" class="tab-pane active">
                            <section class="panel">
                                <div class="panel-body">
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="email">Mật khẩu mới</label>
                                        <div class="col-lg-6">
                                            <input type="password" required="" class="form-control" name="password" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label col-lg-2" for="phone">Nhập lại mật khẩu</label>
                                        <div class="col-lg-6">
                                            <input type="password" required="" class="form-control" name="re_password" value="{{$item->phone}}" >
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
    </div>
    <!-- page end-->
</section>
<script type="text/javascript" src="{{$resources_path}}/js/user.js"></script>