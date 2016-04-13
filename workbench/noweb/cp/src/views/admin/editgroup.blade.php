<section class="wrapper">
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
                <span class="hidden-sm wht-color">Sửa thông tin nhóm thành viên - {{$group->name}}</span>
            </header>
            <form method="post" class="form-horizontal tasi-form" id="edit-group">
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home-3">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label col-lg-2">Tên nhóm</label>
                                        <div class="col-lg-6">
                                            <input type="text" name="name"  value="{{$group->name}}" class="form-control" required="">
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{$group->id}}">
                                    <div class="form-group">
                                        <label for="description" class="col-sm-2 control-label col-lg-2">Mô tả</label>
                                        <div class="col-lg-6">
                                            <textarea name="description" class="form-control" >{{$group->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="re_password" class="col-sm-2 control-label col-lg-2">Kích hoạt</label>
                                        <div class="col-lg-6">
                                            <input type="checkbox" name="active"  class="checkbox form-control" style="width: 10px" value="1" data-value="{{$group->active}}">
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
                                                <label class="label_check c_on"><input data-value="{{$group->privileges}}" class="m-bot15 children" rel="{{$key}}" type="checkbox" name="privileges[]" value="{{$key.'@'.$name}}"/>{{$item['title']}}</label>
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
</section>
<script type="text/javascript" src="{{$resources_path}}/js/user.js"></script>