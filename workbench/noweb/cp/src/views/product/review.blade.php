<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue ">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="/cp/product"><i class="icon-home"></i> Sản phẩm website </a>
            </li>
            <li class="">
                <a href="/cp/product/create"><i class="icon-calendar"></i> Thêm mới sản phẩm</a>
            </li>
            <li class="active">
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
        <form id="form-list-reviews-table">
            <table id="list-reviews-table" class="display table-hover table table-bordered dataTable news-list-table">
                <thead>
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" resource="list-reviews-table" class="check-all">
                        </td>
                        <td>#</td>
                        <td data-value="name" class="sort">Tiêu đề</td>
                        <td>Số điểm</td>
                        <td>Tên sản phẩm</td>
                        <td data-value="created_at" class="sort">Ngày bình chọn</td>
                        <td data-value="status" class="sort">Trạng thái</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $item)
                        <tr data-rel="{{$item->product_id}}">
                            <td class="center"></td>
                            <td class="center open-detail"><span data-value="{{$item['product_id']}}"></span></td>
                            <td>{{$item['review_title']}}</td>
                            <td class="text-right">{{$item['avg_rating']}}</td>
                            <td>{{$item['product_name']}}</td>
                            <td class="text-right">{{ date_format(date_create($item->created_at), 'd.m.Y') }}</td>
                            <td>---</td>
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
</section>
{{-- Form Reply --}}
<form id="reply-review" method="post" style="display: none">
    <div class="form-group">
        <div class="message">
            <h5 class="text-primary"><a class="reviewer_name" href="javascript:;"></a></h5>
            <p class="review_text"></p>
        </div>
    </div>
    <div class="form-group">
        <label for="review_text">Nội dung</label>
        <textarea name="review_text" class="form-control" rows="6" required="" placeholder="Nhập nội dung để trả lời"></textarea>
    </div>
    <input type="hidden" name="id" />
    <input type="hidden" name="product_id" />
    <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
    <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
</form>
{{-- /Form Reply --}}
<script type="text/javascript" src="{{$resources_path}}/js/product-reviews.js"></script>
