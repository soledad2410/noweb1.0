<section>
    <nav role="navigation" class="navbar navbar-inverse">
        <div class="navbar-header">
            <a href="/cp/product-properties" class="navbar-brand">Danh sách thuộc tính sản phẩm</a>
        </div>
    </nav>
    <!-- page start-->
    <div class="row">
        <div class="col-md-4">
            <section class="panel">
                <header class="panel-heading">
                Thêm mới
                </header>
                <div class="panel-body">
                    <form role="form" id="add" method="post">
                        <div class="form-group">
                            <label>Tên</label>
                            <input required="" type="text" placeholder="Tên" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input required="" type="text" placeholder="Tiêu đề" name="title" class="form-control">
                        </div>
                        <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                        <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                    </form>
                    <form id="edit" method="post" style="display: none">
                        <div class="form-group">
                            <label>Tên</label>
                            <input required="" type="text" placeholder="Tên" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input required="" type="text" placeholder="Tiêu đề" name="title" class="form-control">
                        </div>
                        <input type="hidden" name="id">
                        <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                        <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Danh sách
                </header>
                <div class="panel-body">
                    <table class="display table-hover table table-bordered dataTable" id="list-table" >
                        <thead>
                            <tr role="row">
                                <td class="center w3">#</td>
                                <td class="sort sorting w10" data-value="name">Tên</td>
                                <td class="sort sorting w20" data-value="title">Tiêu đề</td>
                                <td class="center w10">Quản lý</td>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach ($proProperties as $item)
                            <tr>
                                <td class="center">{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->title}}</td>
                                <td>
                                    <div class="btn-group">
                                        @if ($item->status == 1)
                                            <a data-toggle="dropdown" href="javascript:;"><i class="icon-eye-open"></i> Hiện</a>
                                        @else
                                            <a data-toggle="dropdown" href="javascript:;"><i class="icon-eye-close"></i> Ẩn</a>
                                        @endif
                                        <ul class="dropdown-menu choose-edit">
                                            <li>
                                                @if ($item->status == 1)
                                                    <a onclick="change_status({{$item->id}}, 0);" data-rel="" href="javascript:;"><i class="icon-circle-arrow-down"></i> Ẩn</a>
                                                @else
                                                    <a onclick="change_status({{$item->id}}, 1);" data-rel="" href="javascript:;"><i class="icon-ok"></i> Hiện</a>
                                                @endif
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a class="edit" href="javascript:;" data-rel="{{$item->id}}"><i class="icon-pencil"></i> Sửa</a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" data-rel="{{$item->id}}" class="delete"><i class="icon-remove"></i> Xóa</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">

                        <div class="col-lg-5">

                            <div class="dataTables_info"> Hiển thị <strong>{{$range['from']}}</strong> - <strong>{{$range['to']}}</strong> / <strong>{{$range['totalRecord']}}</strong> bản ghi</div></div>
                            <div class="col-lg-7">
                                <div class="dataTables_paginate paging_bootstrap pagination">{{$paginator}}</div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- page end-->
</section>
<!--script for this page only-->
<script type="text/javascript" src="{{$resources_path}}/js/product-properties.js"></script>