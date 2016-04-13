<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue ">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="/cp/news" ><i class= "icon-home"></i> Tin tức</a>
            </li>
            <li class="">
                <a href="/cp/category"><i class="icon-reorder"></i> Chuyên mục tin</a>
            </li>
            <li class="active">
                <a href="/cp/news/comments"><i class="icon-comments"></i> Bình luận</a>
            </li>
        </ul>
    </header>
    <nav role="navigation">
        <form role="form" class="form-inline navbar-right" method="get" action="">
            <input type="hidden" name="reply_id" value="{{\Input::get('reply_id')}}">
            <input type="hidden" name="news_id" value="{{\Input::get('news_id')}}">
            <div class="form-group">
                <select class="form-control input-sm" name="status" data-value="{{\Input::get('status')}}">
                    <option value="all">Tất cả trạng thái</option>
                    <option value="0">Chưa duyệt</option>
                    <option value="1">Đã duyệt</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control input-sm" name="news_id" data-value="{{\Input::get('news_id')}}">
                    <option value="all">Tất cả bài viết</option>
                    @foreach ($news as $item)
                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                    @endforeach
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
                    <button class="btn btn-danger btn-sm remove" type="button"><i class="icon-remove"></i> Xóa</button>
                </div>
            </div>
            <form id="comments-list-form">
                <table cellspacing="0" cellpadding="0" border="0"  class="display table-hover table table-bordered dataTable news-list-table" id="comments-list-table">
                    <thead>
                        <tr role="row">
                            <td class="center w3"><input type="checkbox" class="check-all" resource="comments-list-table" /></td>
                            <td data-value="title" class="sort sorting w16">Tiêu đề</td>
                            <td class="w7">Số phản hồi</td>
                            <td data-value="fullname" class="sort sorting w8">Người đăng</td>
                            <td class="w30">Bài viết</td>
                            <td data-value="created_at" class="sort sorting w10">Ngày đăng</td>
                            <td class="center w10">Quản lý</td>
                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        {{$tableTree}}
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
</section>

<script type="text/javascript" src="{{$resources_path}}/js/news-comments.js"></script>
<script type="text/javascript" src="{{$resources_path}}/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>