<section>
    <nav role="navigation" class="navbar navbar-inverse">
        <div class="navbar-header">
            <a href="/cp/tags" class="navbar-brand">Danh sách tag website</a>
        </div>
        <form role="form" class="form-inline navbar-right" method="get" action="">
            <div class="form-group">
                <input value="{{\Input::get('from')}}" type="text" name="from" placeholder="Từ ngày" class="form-control input-sm date-picker search-input">
            </div>
            <div class="form-group">
                <input value="{{\Input::get('to')}}" type="text" name="to" placeholder="Tới ngày" class="form-control input-sm date-picker search-input">
            </div>

            <div class="form-group">
                <input value="{{\Input::get('keyword')}}" type="text" name="keyword" placeholder="Từ khóa"  class="form-control input-sm search-input">
            </div>
            <button class="btn btn-success input-sm" type="submit">Tìm</button>
        </form>
    </nav>
    <!-- page start-->
    <div class="row">
        <div class="col-md-4">
            <section class="panel">
                <header class="panel-heading ">
                    Thêm mới tag
                </header>
                <div class="panel-body">
                    <form role="form" id="add-tag" method="post">
                        <div class="form-group">
                            <label>Tên tag</label>
                            <input required="" type="text" placeholder="name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input required="" type="text" placeholder="slug" name="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                        <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                    </form>
                    <form id="edit-tag" method="post" style="display: none">
                        <div class="form-group">
                            <label>Tên tag</label>
                            <input type="text"  placeholder="name" name="name" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input required="" type="text" placeholder="slug" name="slug" class="form-control">
                        </div>
                        <input type="hidden" name="id"/>
                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                        <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                    </form>
                </div>
            </section>
        </div>
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    Danh sách tag

                    <div class="btn-group pull-right">
                        <button data-toggle="dropdown" class="btn dropdown-toggle btn-warning btn-sm"><i class="icon-list"></i> Export Data
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" class="export-word" resource="tags-list-table"><span class="icon-doc"></span>Save as Word</a></li>
                            <li><a href="javascript:;" class="export-excel" resource="tags-list-table"><span class="icon-xls"></span>Save as Excel </a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:;" class="export-csv" resource="tags-list-table"><span class="icon-csv"></span>Save as CSV </a></li>
                            <li><a href="javascript:;" class="export-png" resource="tags-list-table"><span class="icon-png"></span>Save as PNG (Firefox only)</a></li>

                        </ul>
                    </div>
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <select  size="1" class="form-control per-page btn-sm" data-value="{{\Input::get('per-page')}}">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </header>
                <div class="panel-body">

                    <div class="space15"></div>
                    <table cellspacing="0" cellpadding="0" border="0"  class="display table-hover table table-bordered dataTable tags-list-table" id="tags-list-table" >
                        <thead>
                            <tr role="row">
                                <td class="center ">#</td>
                                <td class="sort sorting" data-value="name">Name</td>
                                <td>Slug</td>
                                <td class="sort sorting" data-value="click">Click</td>
                                <td class="center">#</td>
                                <td class="center">#</td>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all">
                                @foreach($tags as $tag)
                                <tr class="gradeA">
                                    <td class="center open-detail"><span data-value="{{$tag->id}}"></span></td>
                                    <td class="">{{$tag->name}}</td>
                                    <td class=" ">{{$tag->slug}}</td>
                                    <td class="hidden-phone ">{{$tag->click}}</td>
                                    <td class="center"><a class="edit-tag" data-value="{{$tag->id}}" href="javascript:void(0)">Sửa</a></td>
                                    <td class="center"><a class="del-tag" data-value="{{$tag->id}}" href="javascript:void(0)">Xóa</a></td>
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
        <script type="text/javascript" src="{{$resources_path}}/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="{{$resources_path}}/js/tag.js"></script>
        <!-- END JAVASCRIPTS -->
