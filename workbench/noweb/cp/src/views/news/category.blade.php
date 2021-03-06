<style type="text/css">
button.btn.approval.btn-default,button.btn.save.btn-default,button.btn.remove.btn-default,button.btn.takedown.btn-default{display: none}
#news-list-table td{vertical-align: middle}
#edit-category-form{display: none}
</style>
<section class="wrapper">
 <!-- page start-->
<section class="panel">
<header class="panel-heading tab-bg-dark-navy-blue ">
                              <ul class="nav nav-tabs">
                                  <li >
                                      <a href="/cp/news" ><i class= "icon-home"></i> Tin tức</a>
                                  </li>
                                  <li class="active">
                                      <a href="/cp/category"><i class="icon-reorder"></i> Chuyên mục tin</a>
                                  </li>
                                  <li class="">
                                      <a href="/cp/news/comment"><i class="icon-comments"></i> Bình luận</a>
                                  </li>
                              </ul>
                          </header>
<nav role="navigation">

<form role="form" class="form-inline navbar-right" method="get" action="/cp/news">
                                  <div class="form-group">
                                      <select class="form-control input-sm" name="status" data-value="{{\Input::get('status')}}">
                                        <option value="all">Tất cả trạng thái</option>
                                        <option value="0">Chờ duyệt</option>
                                        <option value="1">Đã đăng</option>
                                        <option value="2">Đã hạ</option>
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <select class="form-control input-sm category-tree" name="category_id" data-value="{{\Input::get('category_id')}}">
                                        <option value="all">Tất cả chuyên mục</option>
                                        <option value="0">Chưa phân loại</option>
                                        {{$selectTree}}
                                        <!-- Category tree here -->
                                        <!-- End category tree -->
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <input type="text" name="from" placeholder="Từ ngày" class="form-control input-sm date-picker search-input">
                                  </div>
                                  <div class="form-group">
                                      <input type="text" name="to" placeholder="Tới ngày" class="form-control input-sm date-picker search-input">
                                  </div>

                                  <div class="form-group">
                                      <input type="text" name="keyword" placeholder="Từ khóa"  class="form-control input-sm search-input">
                                  </div>
                                  <button class="btn btn-success btn-sm" type="submit"><i class="icon-eye-open"></i> Lọc tin tức</button>
 </form>
</nav>
                  <div class="panel-body">
                        <div class="adv-table">
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
                                    <a data-toggle="modal" href="#add-category-popup"> <button class="btn btn-info btn-sm" type="button"><i class="icon-plus"></i> Thêm mới</button></a>
                              </div>
                              <div class="btn-group pull-right dataTables_filter">
                                 <button class="btn btn-default btn-sm remove" type="button"><i class="icon-remove"></i> Xóa</button>
                              </div>

                              <form id="category-list-form">
                            <table cellspacing="0" cellpadding="0" border="0"  class="display table-hover table table-bordered dataTable news-list-table" id="category-list-table" >
                                <thead>
                                <tr role="row">
                                    <td class="center w5"><input type="checkbox" class="check-all" resource="category-list-table" /></td>

                                    <td data-value="name" class="sort sorting w30">Tiêu đề</td>
                                    <td >Slug</td>
                                    <td data-value="created_at" class="sort sorting w15">Ngày đăng</td>
                                    <td>#</td>
                                </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                               {{$tableTree}}
                                </tbody>
                            </table>
                            </form>
                        </div>
                  </div>
                  </div>
              </section>
<!-- Add new article section -->
 <!-- page end-->
</section>
<!--script for this page only-->
  <script type="text/javascript" src="{{$resources_path}}/js/category.js"></script>
  <script type="text/javascript" src="{{$resources_path}}/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<!-- Edit category info form -->
                                              <form role="form" class="edit-category-form" method="post" id="edit-category-form">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">Tiêu đề</label>
                                                      <input type="text" placeholder="Tiêu đề chuyên mục" name="name"  class="form-control" required="">
                                                  </div>
                                                  <input type="hidden" name="type" value="news">
                                                  <input type="hidden" name="id">
                                                  <div class="form-group">
                                                      <label for="exampleInputPassword1">Slug</label>
                                                      <input type="text" placeholder="slug" name="slug" class="form-control" required="">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputPassword1">Danh mục cha</label>
                                                      <select name="parent_id" class="form-control category-tree">
                                                        <option value="0">Danh mục gốc</option>
                                                        {{$selectTree}}
                                                      </select>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputFile">Mô tả</label>
                                                      <textarea class="form-control" cols="4" name="description"></textarea>
                                                  </div>
                                                <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
                                                <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                                              </form>
<!-- End of edit form -->

    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="add-category-popup" class="modal fade">
                                  <div class="modal-dialog">,
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                              <h4 class="modal-title">Thêm mới chuyên mục Tin tức</h4>
                                      </div>
                                  <div class="modal-body">
                                    <div class="modal-body">
                                              <form role="form" class="add-category-form" method="post" id="add-category-form">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">Tiêu đề</label>
                                                      <input type="text" placeholder="Tiêu đề chuyên mục" name="name"  class="form-control" required="">
                                                  </div>
                                                  <input type="hidden" name="type" value="news">
                                                  <div class="form-group">
                                                      <label for="exampleInputPassword1">Slug</label>
                                                      <input type="text" placeholder="slug" name="slug" class="form-control" required="">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputPassword1">Danh mục cha</label>
                                                      <select name="parent_id" class="form-control category-tree">
                                                        <option value="0">Danh mục gốc</option>
                                                        {{$selectTree}}
                                                      </select>
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputFile">Mô tả</label>
                                                      <textarea class="form-control" cols="4" name="description"></textarea>
                                                  </div>
                                                <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
                                                <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                                              </form>
                                          </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
<!-- END JAVASCRIPTS -->
