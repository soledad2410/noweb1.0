<link rel="stylesheet" type="text/css" href="{{$resources_path}}/css/gallery.css" />
<section>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="/cp/gallery">Danh sách album ảnh</a>
        </div>
        <form action="" method="get" class="form-inline navbar-right" role="form">
            <div class="form-group">
                <select data-value="{{\Input::get('status')}}" name="status" class="form-control input-sm" >
                    <option value="all">Tất cả trạng thái</option>
                    <option value="0">Chờ duyệt</option>
                    <option value="1">Đã đăng</option>
                    <option value="2">Đã hạ</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control input-sm date-picker search-input" placeholder="Từ ngày" name="from" value="{{\Input::get('from')}}">
            </div>
            <div class="form-group">
                <input type="text" class="form-control input-sm date-picker search-input" placeholder="Tới ngày" name="to" value="{{\Input::get('to')}}">
            </div>

            <div class="form-group">
                <input type="text" class="form-control input-sm search-input" placeholder="Từ khóa" name="keyword" value="{{\Input::get('keyword')}}">
            </div>
            <button type="submit" class="btn btn-success input-sm">Tìm</button>
        </form>
    </nav>
    <div class="row">
        <div class="col-md-3">
            <section class="panel">
                <header class="panel-heading">
                    Danh sách chuyên mục <a class="pull-right" onclick="showAddCateForm()" href="javascript:;"><i class="icon-plus"></i></a>
                </header>
                <div class="panel-body">
                  <ul class="nav prod-cat">
                    <li>
                        <a style="width: 80%" class="pull-left" href="/cp/gallery">
                            <i class="icon-angle-right"></i> Tất cả danh mục
                        </a>
                    </li>
                    @foreach($catalogues as $cat)
                        <li>
                            <a rel="{{$cat->id}}" parent="{{$cat->parent_id}}" style="width: 80%" class="pull-left" href="/cp/gallery?cat={{$cat->id}}">
                                <span class="tree-separator"></span>
                                <i class="icon-angle-right"></i> {{$cat->name}}
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
            <div class="panel-body">
                <div role="grid" class="dataTables_wrapper table-responsive">
                    <div class="btn-group pull-right dataTables_filter">
                        <button data-toggle="dropdown" class="btn dropdown-toggle btn-warning btn-sm"><i class="icon-list"></i> Export Data
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" class="export-word" resource="news-list-table"><span class="icon-doc"></span>Save as Word</a></li>
                            <li><a href="javascript:;" class="export-excel" resource="news-list-table"><span class="icon-xls"></span>Save as Excel </a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:;" class="export-csv" resource="news-list-table"><span class="icon-csv"></span>Save as CSV </a></li>
                            <li><a href="javascript:;" class="export-png" resource="news-list-table"><span class="icon-png"></span>Save as PNG (Firefox only)</a></li>
                        </ul>
                    </div>
                    <div class="btn-group pull-right dataTables_filter">
                        <button class="btn btn-primary btn-sm add-gallery" type="button"><i class="icon-plus"></i> Thêm mới</button>
                    </div>
                    <div class="btn-group pull-right dataTables_filter">
                        <button class="btn btn-danger btn-sm remove" type="button"><i class="icon-remove"></i> Xóa</button>
                    </div>
                </div>
                <form id="galleries-table-list">
                    <table class="display table-hover table table-bordered dataTable news-list-table" id="galleries-list-table">
                        <thead>
                            <tr>
                                <td class="text-center"><input type="checkbox" resource="galleries-list-table" class="check-all"></td>
                                <td data-value="name" class="sort">Tên album</td>
                                <td>Ảnh minh họa</td>
                                <td data-value="created_at" class="sort">Ngày đăng</td>
                                <td data-value="status" class="sort">Trạng thái</td>
                                <td class="sorter w10 text-center">Sắp xếp</td>
                            </tr>
                        </thead>
                        <tbody>
                            {{$tableTree}}
                        </tbody>
                    </table>
                </form>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="dataTables_info"> Hiển thị <strong id="ajax-from">{{$range['from']}}</strong> - <strong id="ajax-to">{{$range['to']}}</strong> / <strong id="ajax-total">{{$range['totalRecord']}}</strong> bản ghi</div></div>
                        <div class="col-lg-7">
                            <div class="dataTables_paginate paging_bootstrap pagination ajax-paginator">{{$paginator}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</section>
{{-- Edit form --}}
<form id="edit-form" method="post" style="display: none">
    <div class="form-group">
        <label>Tên album</label>
        <input type="text" class="form-control" name="name" placeholder="Tên" required="">
        <input type="hidden" name="id" value="">
    </div>
    <div class="form-group">
        <label>Đường dẫn</label>
        <input type="text" class="form-control" name="slug" placeholder="Đường dẫn" required="">
    </div>
    <div class="form-group">
        <label>Danh mục chứa album</label>
        <select class="form-control" name="parent_id">
            <option parent="0" type="album" value="0">Danh mục gốc</option>
            {{$selectTree}}
        </select>
    </div>
    <div class="form-group col-md-5">
        <label>Ảnh đại diện</label>
        <input type="hidden" value="" id="image" name="image">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div id="image-thumb" class="fileupload-new thumbnail" style="width: 200px; height: 150px; margin-bottom: 3px;">
                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
            </div>
            <span class="btn btn-white btn-file" style="margin-bottom: 12px">
                <span class="fileupload-new" onclick="browserImageFile('image')">
                    <i class="icon-paper-clip"></i> Chọn ảnh
                </span>
            </span>
        </div>
    </div>
    <div class="form-group col-md-7">
        <label>Mô tả</label>
        <textarea rows="6" class="form-control" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Lưu</button>
    <button type="button" class="btn btn-default"><i class="icon-refresh"></i>Làm lại</button>
</form>
{{-- /Edit form --}}
{{-- Add form --}}
<form method="post" id="add-gallery" role="form" style="display: none">
    <div class="row">
        <div class="form-group col-md-12">
            <label>Tên album</label>
            <input type="text" class="form-control" name="name" placeholder="Tên" required="">
        </div>
        <div class="form-group col-md-12">
            <label>Đường dẫn</label>
            <input type="text" class="form-control" name="slug" placeholder="Đường dẫn" required="">
        </div>
        <div class="form-group col-md-12">
            <label>Danh mục chứa album</label>
            <select class="form-control" name="parent_id">
                <option parent="0" type="album" value="0">Danh mục gốc</option>
                {{$selectTree}}
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Ảnh đại diện</label>
            <input type="hidden" value="" id="add-image" name="image">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div id="add-image-thumb" class="fileupload-new thumbnail" style="width: 200px; height: 150px; margin-bottom: 3px;">
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                </div>
                <span class="btn btn-white btn-file" style="margin-bottom: 12px">
                    <span class="fileupload-new" onclick="browserImageFile('add-image')">
                        <i class="icon-paper-clip"></i> Chọn ảnh
                    </span>
                </span>
            </div>
        </div>
        <div class="form-group col-md-8">
            <label>Mô tả</label>
            <textarea rows="6" class="form-control" name="description"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Lưu</button>
    <button type="button" class="btn btn-default"><i class="icon-refresh"></i>Làm lại</button>
</form>
{{-- /Add form --}}
{{-- Add cate form --}}
<form role="form" class="add-catalogue-form" method="post" id="add-catalogue-form" style="display:none">
    <div class="form-group">
        <label for="exampleInputEmail1">Tên</label>
        <input type="text" onchange="slugify(this)" placeholder="Tên danh mục" name="name"  class="form-control" required="">
        <input type="hidden" name="status" value="1" />
        <input type="hidden" name="type" value="album" />
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
{{-- /Add cate form --}}
{{-- Edit cate form --}}
<form id="edit-catalogue" method="post" style="display: none">
    <div class="form-group">
        <label for="name">Tên</label>
        <input type="text" placeholder="Tên danh  mục" name="name"  class="form-control" required="">
    </div>
    <div class="form-group">
        <label>Danh mục cha</label>
        <select class="form-control" name="parent_id">
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
{{-- /Edit cate form --}}
<script type="text/javascript" src="{{$resources_path}}/js/gallery.js"></script>
<script type="text/javascript" src="{{$resources_path}}/js/jquery.rowsorter.js"></script>