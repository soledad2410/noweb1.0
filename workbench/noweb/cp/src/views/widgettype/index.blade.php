<section>
    <nav role="navigation" class="navbar navbar-inverse">
        <div class="navbar-header">
            <a href="/cp/widget-type" class="navbar-brand">Danh sách loại khối</a>
        </div>
    </nav>
    <!-- page start-->
    <section class="panel">
        <div class="panel-body">
            <div style="display: inline-block;width:100%" class="dataTables_wrapper table-responsive" role="grid">
                    <div class="btn-group pull-right dataTables_filter">
                        <a href="/cp/widget-type/create">
                            <button type="button" class="btn btn-info btn-sm"><i class="icon-plus"></i> Thêm mới</button>
                        </a>
                    </div>
                </div>
            <table class="display table-hover table table-bordered dataTable" id="news-list-table" >
                <thead>
                    <tr role="row">
                        <td class="center w3">#</td>
                        <td class="sort sorting w20" data-value="title">Tiêu đề</td>
                        <td class="sort sorting w10" data-value="name">Tên</td>
                        <td class="w40" data-value="description">Mô tả</td>
                        <td class="center w10">Quản lý</td>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                    @foreach ($widgetType as $item)
                        <tr>
                            <td class="center">{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td class="center">
                                <a class="btn btn-xs btn-primary" href="/cp/widget-type/edit/{{$item->id}}">
                                    <i class="icon-pencil"></i>
                                </a>
                                <a href="javascript:;" data-rel="{{$item->id}}" class="btn btn-xs btn-danger delete">
                                    <i class="icon-remove"></i>
                                </a>
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
<!-- page end-->
</section>
<!--script for this page only-->
<script type="text/javascript" src="{{$resources_path}}/js/widget-type.js"></script>