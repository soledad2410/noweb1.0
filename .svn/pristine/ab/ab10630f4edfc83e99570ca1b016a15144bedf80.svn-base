<section>
    <!-- page start-->
    <section class="panel">
        <header class="panel-heading tab-bg-dark-navy-blue ">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="/cp/news" ><i class= "icon-home"></i> Tin tức</a>
                </li>
                <li class="">
                    <a href="/cp/category"><i class="icon-reorder"></i> Chuyên mục tin</a>
                </li>
                <li class="">
                    <a href="/cp/news/comments"><i class="icon-comments"></i> Bình luận</a>
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
                    <select class="form-control input-sm" name="category_id" data-value="{{\Input::get('category_id')}}">
                        <option value="all">Tất cả chuyên mục</option>
                        <option value="0">Chưa phân loại</option>
                        <!-- Category tree here -->
                        {{ $selectTreeView }}
                        <!-- End category tree -->
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
                <button class="btn btn-success btn-sm" type="submit"><i class="icon-eye-open"></i> Lọc tin tức</button>
            </form>
        </nav>
        <div class="panel-body">
            <div class="adv-table">
                <div role="grid" class="dataTables_wrapper table-responsive" style="display: inline-block;width:100%">
                    <div class="dataTables_length pull-left" style="display: inline-block">
                        <label>Show <select class="form-control per-page" data-value="{{\Input::get('per-page')}}"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> record</label>
                    </div>
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
                        <a href="/cp/news#news-create-form"> <button class="btn btn-info btn-sm" type="button"><i class="icon-plus"></i> Thêm mới</button></a>
                    </div>
                    <div class="btn-group pull-right dataTables_filter">
                        <button class="btn btn-danger btn-sm remove" type="button"><i class="icon-remove"></i> Xóa</button>
                    </div>
                    <div class="btn-group pull-right dataTables_filter">
                        <button class="btn btn-primary news-task btn-sm approval" data-value="1" type="button"><i class="icon-circle-arrow-up"></i> Đăng bài</button>
                    </div>
                    <div class="btn-group pull-right dataTables_filter">
                        <button class="btn btn-default news-task btn-sm takedown" data-value="2" type="button"><i class="icon-circle-arrow-down"></i> Hạ bài</button>
                    </div>
                </div>
                <form id="news-list-form">
                    <table cellspacing="0" cellpadding="0" border="0"  class="display table-hover table table-bordered dataTable news-list-table" id="news-list-table" >
                        <thead>
                            <tr role="row">
                                <td class="center w3"><input type="checkbox" class="check-all" resource="news-list-table" /></td>
                                <td class="center w3">#</td>
                                <td data-value="name" class="sort sorting w30">Tiêu đề</td>
                                <td data-value="created_at" class="sort sorting w10">Ngày đăng</td>
                                <td data-value="published_time" class="sort sorting w10">Ngày xuất bản</td>
                                <td data-value="user_id" class="sort sorting w10">Người đăng</td>
                                <td class="w15">Chuyên mục</td>
                                <td data-value="order_num" class="center w5 sort sorting"><i class="icon-sort-by-order"></i> </td>
                                <td class="center w10" >Trạng thái</td>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($newss as $news)
                            <tr rel="{{$news->id}}">
                                <td class="center"><input type="checkbox" name="id[]" value="{{$news->id}}"></td>
                                <td class="center open-detail"><span data-value="{{$news->id}}"></span></td>
                                <td >{{$news->name}}</td>
                                <td >{{formatDatetimeVi($news->created_at)}}</td>
                                <td >{{formatDatetimeVi($news->published_time)}}</td>
                                <td >{{$news->user->username or 'Anonymous'}}</td>
                                <td class="news-cates">
                                    <?php $cate_name = explode(',', $news->cat_name);?>
                                    <?php $cate_id = explode(',', $news->cat_id);?>
                                    @foreach ($cate_id as $key => $value)
                                        @if ($cate_name[$key])
                                            <a href="/cp/news?cat={{$value}}">{{$cate_name[$key]}}</a>
                                        @endif
                                    @endforeach
                                </td>
                                <td><input type="text" rel="{{$news->id}}"  value="{{$news->order_num}}" class="form-control input-sm number-field order-num"></td>
                                <td>
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" href="javascript:;">
                                            @if($news->status == 0)
                                            <i class="icon-archive"></i> Lưu nháp
                                            @endif
                                            @if($news->status == 1)
                                            <i class="icon-ok"></i> Đã đăng
                                            @endif
                                            @if($news->status == 2)
                                            <i class="icon-circle-arrow-down"></i> Đã hạ
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu btn-sm choose-edit">
                                            <li><a class="news-task" data-rel="{{$news->id}}" data-value="1" href="javascript:;"><i class="icon-circle-arrow-up"></i> Đăng bài</a></li>
                                            <li><a class="news-task" data-rel="{{$news->id}}" data-value="2" href="javascript:;"><i class="icon-circle-arrow-down"></i> Hạ bài</a></li>
                                            <li class="divider"></li>
                                            <li><a class="edit-news" href="javascript:;" data-rel="{{$news->id}}"><i class="icon-edit"></i> Sửa</a></li>
                                            <li><a class="delete-news" data-rel="{{$news->id}}" href="javascript:;" data-rel="{{$news->id}}"><i class="icon-remove"></i> Xóa</a></li>
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
                        <div class="dataTables_info"> Hiển thị <strong>{{$range['from']}}</strong> - <strong>{{$range['to']}}</strong> / <strong>{{$range['totalRecord']}}</strong> bản ghi</div>
                    </div>
                    <div class="col-lg-7">
                        <div class="dataTables_paginate paging_bootstrap pagination">{{$paginator}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Add new article section -->
<div class="row">
    <form method="post" class="form-horizontal tasi-form" id="news-create-form">
        <div class="col-lg-8">
            <section class="panel">

                <header class="panel-heading">
                    Thêm mới bài viết
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tiêu đề</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$newsCache->name or ''}}" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Slug</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$newsCache->slug or ''}}" class="form-control" name="slug" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Brief</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="6" name="brief">{{$newsCache->brief or ''}}</textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" name="content" rows="6">{{$newsCache->content or ''}}</textarea>
                            <script type="text/javascript">
                                initCKeditor('content');
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                            <button type="button" class="btn btn-success draft-news"><i class="icon-archive"></i> Chỉ lưu</button>
                            <button type="submit" class="btn btn-success publish-news"><i class="icon-ok"></i> Lưu và xuất bản</button>
                            <button type="button" class="btn btn-success draft-news-preview"><i class="icon-eye-open"></i> Xem trước</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-4">
            <section class="panel">
                <header class="panel-heading">
                    Tùy chọn bài viết
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Hiển thị</label>
                        <div class="col-lg-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="status" {{isset($newsCache->status) ? 'checked' : '';}}> Hiển thị
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="show_home" {{isset($newsCache->show_home) ? 'checked' : '';}}> Trang chủ
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="show_hot" {{isset($newsCache->show_hot) ? 'checked' : '';}}> Tin hot
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="comment_allowed" {{isset($newsCache->comment_allowed) ? 'checked' : '';}}> Được bình luận
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label col-lg-4">Chuyên mục</label>
                        <div class="col-lg-8 tree-view" style="max-height: 180px;overflow-y: scroll">
                            {{$checkboxTreeView}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label col-lg-4">Ảnh đại diện</label>
                        <div class="col-lg-8">
                            <input type="hidden" name="thumbnail" id="thumbnail" value="{{$newsCache->thumbnail or ''}}"/>
                            <div data-provides="fileupload" class="fileupload fileupload-new">
                                <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail" id="thumbnail-thumb">
                                    <img alt="" src="{{isset($newsCache->thumbnail) && trim($newsCache->thumbnail) != '' ? $newsCache->thumbnail : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';}}">
                                </div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new get-thumbnail"><i class="icon-paper-clip"></i> Select image</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label col-lg-4">Thời gian xuất bản</label>
                        <div class="col-lg-8">
                            <input name="published_time" class="form-control datetime-picker" value="{{$newsCache->published_time or date('H:i d-m-Y')}}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label col-lg-4">Thời gian hết hạn</label>
                        <div class="col-lg-8">
                            <input name="expire_time" class="form-control datetime-picker" value="{{$newsCache->expire_time or ''}}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label col-lg-6">Tin tức liên quan <a href="#related-news-table" data-toggle="modal" > <i style="cursor: pointer" class="icon-plus "></i> </a></label>

                    </div>
                    <div class="form-group">
                        <input type="hidden" id="related_news" name="related_news" value="{{$newsCache->related_news or ''}}">
                        <div class="col-lg-12" id="news-related-list">
                            @foreach($relatedNews as $item)
                            <p data-value="{{$item->id}}"><a onclick="removeRelateNews(this)" data-value="{{$item->id}}" href="javascript:;" title="Xóa khỏi danh sách"> <i class="icon-minus"></i></a>{{$item->name}}
                                <a href="javascript:;">
                                    @if($item->status == 0)
                                    <i class="icon-archive"></i> Lưu nháp
                                    @endif
                                    @if($item->status == 1)
                                    <i class="icon-ok"></i> Đã đăng
                                    @endif
                                    @if($item->status == 2)
                                    <i class="icon-circle-arrow-down"></i> Đã hạ
                                    @endif
                                </a>
                            </p>
                            @endforeach
                        </div>
                    </div>
                </div>

            </section>
            <div class="accordion" class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#meta-group" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
                                <i class="icon-plus"></i> Thẻ meta
                            </a>
                        </h4>
                    </div>
                    <div class="panel-collapse collapse" id="meta-group">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Meta keyword</label>
                                <div class="col-sm-8">
                                    <textarea name="meta_keyword" class="form-control">{{$newsCache->meta_keyword or ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Meta description</label>
                                <div class="col-sm-8">
                                    <textarea name="meta_description" class="form-control">{{$newsCache->meta_description or ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 col-sm-4 control-label">Meta h1</label>
                                <div class="col-sm-8">
                                    <textarea name="meta_h1" class="form-control">{{$newsCache->meta_h1 or ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label col-lg-4">Tags bài viết <a href="#tags-table" data-toggle="modal" > <i style="cursor: pointer" class="icon-plus "></i> </a></label>
                                <div class="col-lg-8">
                                    <div class="panel-body" style="border:1px solid #e2e2e4;border-radius: 5px" id="selected-tags">
                                        @foreach($selectedTags as $tag)
                                        <a data-value="{{$tag->id}}" href="javascript:;" class="btn btn-default btn-sm tag-item-remove" style="margin:5px"><i class="icon-minus"></i> {{$tag->name}}</a>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="tags" value="{{$newsCache->tags}}"/>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- page end-->
</section>
<!--script for this page only-->

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="related-news-table" class="modal fade">
    <div class="modal-dialog">,
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Chọn tin tức</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="pull-right" style="margin-bottom: 15px">
                        <form role="form" class="form-inline form-ajax-list-news">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="sr-only">Chuyên mục</label>
                                <select name="category_id" class="form-control input-sm">
                                    <option value="all">Tất cả</option>
                                    <option value="0">Chưa phân loại</option>
                                </select>
                            </div>
                            <input type="hidden" id="ajax_category_id">
                            <input type="hidden" id="ajax_keyword">
                            <div class="form-group">
                                <label class="sr-only">Từ khóa</label>
                                <input type="text" placeholder="Từ khóa" name="keyword" class="form-control input-sm">
                            </div>
                            <button class="btn btn-success  btn-sm" type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                    <input type="hidden" id="per-page" value="{{\Input::get('per-page') or 10}}"/>
                    <table cellspacing="0" cellpadding="0" border="0"  class="display table-hover table table-bordered dataTable news-list-table-compact" id="news-list-table-compact" >
                        <thead>
                            <tr role="row">
                                <td class="center w5"></td>
                                <td class="sort sorting w25">Tiêu đề</td>
                                <td class="center w15">Người đăng</td>
                                <td class="w15">#</td>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($newssAjax as $news)
                            <tr rel="{{$news->id}}" {{in_array($news->id,explode('|',$newsCache->related_news)) ? 'class="selected"' : '';}}>
                                <td class="center"><input type="checkbox" name="id[]" value="{{$news->id}}" {{in_array($news->id,explode('|',$newsCache->related_news)) ? 'checked' : '';}}></td>
                                <td class="title" >{{$news->name}}</td>
                                <td class="center">{{$news->user->username}}</td>
                                <td class="status"><a  href="javascript:;">
                                    @if($news->status == 0)
                                    <i class="icon-archive"></i> Lưu nháp
                                    @endif
                                    @if($news->status == 1)
                                    <i class="icon-ok"></i> Đã đăng
                                    @endif
                                    @if($news->status == 2)
                                    <i class="icon-circle-arrow-down"></i> Đã hạ
                                    @endif
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="dataTables_info"> Hiển thị <strong id="ajax-from">{{$range['from']}}</strong> - <strong id="ajax-to">{{$range['to']}}</strong> / <strong id="ajax-total">{{$range['totalRecord']}}</strong> bản ghi</div></div>
                        <div class="col-lg-7">
                            <div class="dataTables_paginate paging_bootstrap pagination ajax-paginator">{{$ajaxPaginator}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TAGS FORM TABLE -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tags-table" class="modal fade">
    <div class="modal-dialog">,
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Chọn Tags từ danh sách</h4>
            </div>
            <div class="modal-body">
                <div class="panel-body" style="border: 1px solid #eee;border-radius:5px ">
                    @foreach($tags as $tag)
                    <a style="margin:5px" class="btn btn-default btn-sm tag-item" href="javascript:;" data-value="{{$tag->id}}"><i class="icon-plus"></i> {{$tag->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END JAVASCRIPTS -->
<script type="text/javascript" src="{{$resources_path}}/js/news.js"></script>
<script type="text/javascript" src="{{$resources_path}}/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>