<style type="text/css" media="screen">
    #contact-detail .form-group {
        border-bottom: 1px solid #eff2f7;
        padding: 5px 0 0;
    }
    #contact-detail .form-group span {
        font-weight: bold;
    }
</style>
<section class="panel">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="/cp/contacts">Quản trị liên hệ</a>
        </div>
        <form action="" method="get" class="form-inline navbar-right" role="form">
            <div class="form-group">
                <select data-value="{{\Input::get('status')}}" name="status" class="form-control input-sm" >
                    <option value="all">Tất cả trạng thái</option>
                    <option value="0">Chưa đọc</option>
                    <option value="1">Đã xem</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success input-sm">Lọc</button>
        </form>
        <form action="" method="post" class="form-inline navbar-right" role="form">
            <select class="form-control per-page" data-value="{{\Input::get('per-page')}}"><option value="10" selected="selected">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>
        </form>
    </nav>
    <nav role="navigation" style="margin-top: 15px;padding: 0px 15px" class="text-right">
        <div class="row">
            <div class="col-md-4 text-left">
                <div class="btn-group">
                    <button class="btn btn-danger btn-sm remove pull-left" type="button"><i class="icon-remove"></i> Xóa</button>
                </div>
            </div>
        </div>
    </nav>
    <div class="panel-body">
        <div class="adv-table">
            <form id="contacts-list-form">
                <table cellspacing="0" cellpadding="0" border="0"  class="display table-hover table table-bordered dataTable news-list-table" id="contacts-list-table">
                    <thead>
                        <tr role="row">
                            <td class="center w3">
                                <input type="checkbox" class="check-all" resource="contacts-list-table" />
                            </td>
                            <td data-value="contact_user" class="sort sorting w15">Tên khách hàng</td>
                            <td data-value="name" class="sort sorting w15">Điện thoại</td>
                            <td data-value="contact_email" class="sort sorting w15">Địa chỉ email</td>
                            <td data-value="created_at" class="sort sorting w12">Ngày gửi</td>
                            <td class="w12">Địa chỉ ip</td>
                            <td class="w15">Phòng ban</td>
                            <td data-value="contact_status" class="sort sorting">Trạng thái</td>
                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all" class="nestable">
                        @foreach ($contacts as $item)
                            <tr data-rel="{{$item['id']}}">
                                <td class="center">
                                    <input type="checkbox" value="{{$item['id']}}" name="id[]">
                                </td>
                                <td>{{$item['contact_user']}}</td>
                                <td><a href="tel:{{$item['contact_phone']}}">{{$item['contact_phone']}}</a></td>
                                <td><a href="mailto:{{$item['contact_email']}}">{{$item['contact_email']}}</a></td>
                                <td>{{$item['created_at']}}</td>
                                <td>{{$item['ip_address']}}</td>
                                <td><a href="mailto:{{$item['department_name']}}">{{$item['department_name']}}</a></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="javascript:;" data-toggle="dropdown">
                                            @if ($item['contact_status'] == 0)
                                                <i class="icon-envelope"></i> Chưa đọc
                                            @elseif ($item['contact_status'] == 1)
                                                <i class="icon-check"></i> Đã xem
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu btn-sm choose-edit">
                                            <li>
                                                <a onclick="view_detail_contact({{$item['id']}})" data-rel="{{$item['id']}}" data-toggle="modal" href='#view-contact'>
                                                    <i class="icon-ok-sign"></i> Xem chi tiết
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="javascript:;" data-rel="{{$item['id']}}" class="delete">
                                                    <i class="icon-remove"></i> Xóa
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
                    <div class="dataTables_info"> Hiển thị <strong>{{$range['from']}}</strong> - <strong>{{$range['to']}}</strong> / <strong>{{$range['totalRecord']}}</strong> bản ghi</div>
                </div>
                <div class="col-lg-7">
                    <div class="dataTables_paginate paging_bootstrap pagination">{{$paginator}}</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--script for this page only-->
<script type="text/javascript" src="{{$resources_path}}/js/contact.js"></script>
