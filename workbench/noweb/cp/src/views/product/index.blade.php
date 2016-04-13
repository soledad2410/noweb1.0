<section>
    <!-- page start-->
    <div class="row">
        <div class="col-md-3 no-padding-right">
            <section class="panel">
                <header class="panel-heading">
                    Danh mục sản phẩm <a data-toggle="modal" href="#add-catalogue"><i class="icon-plus"></i></a>
                </header>
                <div class="panel-body">
                    <ul class="nav prod-cat">
                        <li><a style="width: 80%" class="pull-left" href="/cp/product"><i class="icon-angle-right"></i> Tất cả danh mục</a></li>
                        @foreach($catalogues as $cat)
                        <li>
                            <a rel="{{$cat->id}}" parent="{{$cat->parent_id}}" style="width: 80%" class="pull-left" href="/cp/product?cat={{$cat->id}}">
                                <span class="tree-separator"></span><i class="icon-angle-right"></i> {{$cat->name}}
                            </a>
                            <a href="javascript:;" class="pull-right edit-catalogue" title="{{$cat->name}}" data-value="{{$cat->id}}">
                                <i class="icon-edit"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
        <div class="col-md-9">
            <section class="panel">
                <header class="panel-heading tab-bg-dark-navy-blue ">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="/cp/product"><i class="icon-home"></i> Sản phẩm website </a>
                        </li>
                        <li class="">
                            <a href="/cp/product/create"><i class="icon-calendar"></i> Thêm mới sản phẩm</a>
                        </li>
                        <li class="">
                            <a href="/cp/product/review"><i class="icon-bar-chart"></i> Đánh giá của sản phẩm</a>
                        </li>
                    </ul>
                </header>
                <nav role="navigation">

                    <form role="form" class="form-inline navbar-right" method="get" action="">
                        <div class="form-group">
                            <select class="form-control input-sm" name="status" data-value="{{\Input::get('status')}}">
                                <option value="all">Tất cả trạng thái</option>
                                <option value="0">Chờ duyệt</option>
                                <option value="1">Đã đăng</option>
                                <option value="2">Đã hạ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input value="{{\Input::get('from')}}" type="text" name="from" placeholder="Từ ngày" class="form-control input-sm date-picker search-input">
                        </div>
                        <div class="form-group">
                            <input value="{{\Input::get('to')}}" type="text" name="to" placeholder="Tới ngày" class="form-control input-sm date-picker search-input">
                        </div>

                        <div class="form-group">
                            <input value="{{\Input::get('keyword')}}" type="text" name="keyword" placeholder="Từ khóa"  class="form-control input-sm search-input">
                        </div>
                        <button class="btn btn-success btn-sm" type="submit"><i class="icon-eye-open"></i> Lọc</button>
                    </form>
                </nav>
                <div class="panel-body">
                    <div role="grid" class="dataTables_wrapper table-responsive" style="display: inline-block;width:100%">
                        <div class="dataTables_length pull-left" style="display:inline-block">
                            <label>Show <select class="form-control per-page" style="display:inline-block" data-value="{{\Input::get('per-page')}}"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> record</label>
                        </div>
                        <div class="btn-group pull-right dataTables_filter">
                            <button data-toggle="dropdown" class="btn dropdown-toggle btn-info btn-sm"><i class="icon-list"></i> Tác vụ
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:;" class="import-excel" ><span class="icon-xls"></span> Thêm từ  file excel</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:;" class="export-excel" resource="news-list-table"><span class="icon-xls"></span>Xuất file excel</a></li>
                            </ul>
                        </div>
                        <div class="btn-group pull-right dataTables_filter">
                            <button type="button" class="btn btn-danger btn-sm remove"><i class="icon-remove"></i> Xóa</button>
                        </div>
                    </div>
                    <form id="form-list-products-table">
                        <table class="display table-hover table table-bordered dataTable news-list-table" id="list-products-table">
                            <thead>
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" class="check-all" resource="list-products-table">
                                    </td>
                                    <td class="sort" data-value="name">Tên sản phẩm</td>
                                    <td>Ảnh minh họa</td>
                                    <td class="sort" data-value="price">Giá</td>
                                    <td class="sort" data-value="created_at">Ngày đăng</td>
                                    <td class="sort" data-value="status">Trạng thái</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $p)
                                <tr rel="{{$p->id}}">
                                    <td class="center">
                                        <input type="checkbox" value="{{$p->id}}" name="id[]">
                                    </td>
                                    <td class="p-name">
                                        <a href="javascript:;">{{ $p->name }}</a>
                                        <br>
                                        <small>Mã: {{ $p->code }}</small>
                                    </td>
                                    <td class="p-team">
                                        <a href="javascript:;">
                                            <img src="{{ $p->getThumbnail() }}" class="" alt="image">
                                        </a>
                                    </td>
                                    <td>
                                        {{ number_format($p->price) }} VNĐ
                                    </td>
                                    <td>
                                        {{ date_format(date_create($p->created_at), 'd.m.Y') }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" href="javascript:;">
                                                @if($p->status == 0)
                                                <i class="icon-archive"></i> Lưu nháp
                                                @endif
                                                @if($p->status == 1)
                                                <i class="icon-ok"></i> Đã đăng
                                                @endif
                                                @if($p->status == 2)
                                                <i class="icon-circle-arrow-down"></i> Đã hạ
                                                @endif
                                            </a>
                                            <ul class="dropdown-menu choose-edit btn-sm">
                                                <li>
                                                    <a href="javascript:;" data-rel="{{$p->id}}" onclick="change_status({{$p->id}}, 1);">
                                                        <i class="icon-ok"></i> Đăng
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;" data-rel="{{$p->id}}" onclick="change_status({{$p->id}}, 2);">
                                                        <i class="icon-circle-arrow-down"></i> Hạ
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a onclick="showEditProductForm({{$p->id}})" href="javascript:;" data-rel="{{$p->id}}">
                                                        <i class="icon-pencil"></i> Sửa nhanh
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="adv-edit" href="javascript:;" data-rel="{{$p->id}}">
                                                        <i class="icon-pencil"></i> Sửa chi tiết
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="copy-product" href="javascript:;" data-rel="{{$p->id}}"><i class="icon-copy"></i> Sao chép
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="delete-product" data-rel="{{$p->id}}" href="javascript:;"><i class="icon-remove"></i> Xóa
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="dataTables_info"> Hiển thị <strong>{{$range['from']}}</strong> - <strong>{{$range['to']}}</strong> / <strong>{{$range['totalRecord']}}</strong> bản ghi
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="dataTables_paginate paging_bootstrap pagination">{{$paginator}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<!-- page end-->
</section>
<!-- Add catalogue modal form -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="add-catalogue" class="modal fade">
    <div class="modal-dialog">,
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Thêm mới danh mục hàng hóa</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form role="form" class="add-catalogue-form" method="post" id="add-catalogue-form">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" onchange="slugify(this)" placeholder="Tên danh mục" name="name"  class="form-control" required="">
                            <input type="hidden" name="status" value="1" />
                            <input type="hidden" name="type" value="product" />
                            <input type="hidden" name="slug" id="slug" value="" />
                        </div>
                        <div class="form-group">
                            <label>Danh mục cha</label>
                            <select class="form-control" name="parent_id">
                                <option parent="0" type="album" value="0">Danh mục gốc</option>
                                {{$selectTree}}
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
                        <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Edit catalog form -->
<form id="edit-catalogue" method="post" style="display: none">
    <div class="form-group">
        <label for="name">Tên</label>
        <input type="text" placeholder="Tên danh mục" name="name"  class="form-control" required="">
    </div>
    <div class="form-group">
        <label>Danh mục cha</label>
        <select class="form-control" name="parent_id" data-value="">
            <option parent="0" type="album" value="0">Danh mục gốc</option>
            {{$selectTree}}
        </select>
    </div>
    <input type="hidden" name="id" />
    <input type="hidden" name="slug" />
    <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
    <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
    <button type="button" class="btn btn-danger delete-catalogue"><i class="icon-remove"></i> Xóa</button>
</form>
{{-- Product edit form --}}
<form role="form" class="product-form" method="post" id="product-edit-form" style="display: none">
    <div class="form-group col-lg-6">
        <label>Mã <span class="require"> (*)</span></label>
        <input type="text"  name="code"  class="form-control" required="">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="slug" value="">
    </div>
    <div class="form-group col-lg-6">
        <label>Tên <span class="require">(*)</span></label>
        <input type="text"  name="name"  class="form-control" required="">
    </div>
    <div class="form-group col-lg-6">
        <label>Ảnh</label>
        <input type="hidden" name="image" id="image" value=""/>
        <div data-provides="fileupload" class="fileupload fileupload-new">
            <div class="fileupload-new thumbnail" id="image-thumb">
                <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
            </div>
            <div>
                <span class="btn btn-white btn-file">
                    <span onclick="browserImageFile('image')" class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group col-lg-6">
        <label class="control-label">Chuyên mục</label>
        <div class="tree-view" style=";max-height: 180px;overflow-y: scroll">
            {{$radioTreeView}}
        </div>
    </div>
    <div class="form-group col-lg-6">
        <label>Giá</label>
        <input type="text" name="price" class="form-control"/>
    </div>
    <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
    <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
</form>
<script type="text/javascript" src="{{$resources_path}}/js/product.js"></script>
