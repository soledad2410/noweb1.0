<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue ">
        <ul class="nav nav-tabs">

            <li class="active">
                <a href="/cp/category"><i class="icon-reorder"></i> Danh mục - Trang nội dung website</a>
            </li>

        </ul>
    </header>
    <nav role="navigation" style="margin-top: 15px;padding: 0px 15px" class="text-right">
        <div class="btn-group">
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
        <div class="btn-group">
            <a href="/cp/category#form-add-cate"> <button class="btn btn-info btn-sm" type="button"><i class="icon-plus"></i> Thêm mới</button></a>
        </div>
        <div class="btn-group">
            <button class="btn btn-danger btn-sm remove" type="button"><i class="icon-remove"></i> Xóa</button>
        </div>
    </nav>
    <div class="panel-body">
        <div class="adv-table">
            <form id="category-list-form">
                <table cellspacing="0" cellpadding="0" border="0"  class="display table-hover table table-bordered dataTable news-list-table" id="category-list-table">
                    <thead>
                        <tr role="row">
                            <td class="center w5"><input type="checkbox" class="check-all" resource="category-list-table" /></td>

                            <td data-value="name" class="sort sorting w30">Tiêu đề</td>
                            <td>Slug</td>
                            <td data-value="created_at" class="sort sorting w15">Ngày đăng</td>
                            {{-- <td class="center w5 sort"><i class="icon-sort-by-order"></i> </td> --}}
                            <td>Trạng thái</td>
                            <td class="center">---</td>
                        </tr>
                    </thead>
                    <tbody role="alert" aria-live="polite" aria-relevant="all" class="nestable">
                        {{$tableTree}}
                    </tbody>
                </table>
            </form>
        </div>
    </div>

</section>
<!-- Add new category section -->
<div class="row">

    <form method="post" id="form-add-cate" class="form-horizontal tasi-form add-category-form">
        <div class="col-lg-12">
            <section class="panel  taskbar">

                <header class="panel-heading text-right">

                   <span class="taskbar-title"><i class="icon-reorder"></i>Thêm mới chuyên mục</span>


                   <button class="btn btn-success" type="submit"><i class="icon-ok"></i> Lưu</button>
                   <button class="btn btn-default" type="button"><i class="icon-refresh"></i> Làm lại</button>

               </header>
           </section>
       </div>
       <div class="col-lg-8">
        <section class="panel">

            <header class="panel-heading">
                Thông tin cần thiết
            </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tiêu đề</label>
                    <div class="col-sm-8">
                        <input type="text" value="" class="form-control" name="name" onkeyup="slugify(this)" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Slug</label>
                    <div class="col-sm-8">
                        <input type="text" value="" class="form-control" name="slug" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Danh mục cha</label>
                    <div class="col-sm-8">
                        <select name="parent_id" class="form-control category-tree">
                            <option value="0">Danh mục gốc</option>
                            {{$selectTree}}
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Trang</label>
                    <div class="col-sm-8">
                        <select name="type" class="form-control" id="cate-type">
                          {{$selectModule}}
                      </select>
                  </div>
              </div>

              <div class="form-group cate-type" data-val="link">
                <label class="col-sm-2 col-sm-2 control-label">Link liên kết</label>
                <div class="col-sm-8">
                    <input type="text" placeholder="Mặc định để trống" value="" class="form-control" name="link">
                </div>
            </div>
        </div>
    </section>
    <div class="accordion cate-type" class="panel-group" data-val="custom_page">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a href="#custom-page" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
                        <i class="icon-plus"></i> Nội dung trang riêng (Đối với loại trang nội dung riêng)
                    </a>
                </h4>
            </div>
            <div class="panel-collapse collapse" id="custom-page">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" name="description" rows="6"></textarea>
                            <script type="text/javascript">
                                initCKeditor('description');
                            </script>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <section class="panel">
        <header class="panel-heading">
            Tùy chọn danh mục
        </header>
        <div class="panel-body">
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Đăng</label>
                <div class="col-lg-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="1" name="status" checked>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Hiện trên menu</label>
                <div class="col-lg-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="1" name="show_menu" checked>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Template</label>
                <div class="col-lg-8">
                    <select name="template" class="form-control">
                        <option value="default">Mặc định</option>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Layout</label>
                <div class="col-lg-8">
                    <select name="layout" class="form-control">
                        <option value="default">Mặc định</option>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label col-lg-4">Ảnh đại diện</label>
                <div class="col-lg-8">
                    <input type="hidden" name="image" id="thumbnail" value=""/>
                    <div data-provides="fileupload" class="fileupload fileupload-new">
                        <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail" id="thumbnail-thumb">
                            <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                        </div>
                        <div>
                            <span class="btn btn-white btn-file">
                             <span class="fileupload-new get-thumbnail" onclick="browserImageFile('thumbnail')"><i class="icon-paper-clip"></i> Select image</span>
                         </span>
                     </div>
                 </div>
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
                        <textarea name="meta_keyword" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Meta description</label>
                    <div class="col-sm-8">
                        <textarea name="meta_desc" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 col-sm-4 control-label">Meta h1</label>
                    <div class="col-sm-8">
                        <textarea name="meta_h1" class="form-control"></textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<div class="clearfix"></div>
<div class="col-lg-12">
    <section class="panel taskbar">

        <header class="panel-heading text-right">
            <button class="btn btn-success publish-news" type="submit"><i class="icon-ok"></i> Lưu</button>
            <button class="btn btn-default" type="button"><i class="icon-refresh"></i> Làm lại</button>
        </header>
    </section>
</div>
</form>
</div>
<!-- page end-->

<!-- Edit category info form -->
<form id="edit-category-form" method="post" style="display: none">
    <div class="form-group">
        <label>Tiêu đề</label>
        <input type="text" value="" class="form-control" name="name" required>
        <input type="hidden" value="" name="id" />
    </div>
    <div class="form-group">
        <label>Slug</label>
        <input type="text" value="" class="form-control" name="slug" required>
    </div>

    <div class="form-group">
        <label>Danh mục cha</label>
        <select name="parent_id" class="form-control category-tree">
            <option value="0">Danh mục gốc</option>
            {{$selectTree}}
        </select>
    </div>

    <div class="form-group">
        <label>Trang</label>
        <select name="type" class="form-control" id="cate-type">
          {{$selectModule}}
      </select>
  </div>

  <div class="form-group cate-type" data-val="link">
    <label>Link liên kết</label>
    <input type="text" placeholder="Mặc định để trống" value="" class="form-control" name="link">
</div>
<button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
<button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
</form>
<!-- End of edit form -->

<!--script for this page only-->
<script type="text/javascript" src="{{$resources_path}}/js/jquery.rowsorter.js"></script>
<script type="text/javascript" src="{{$resources_path}}/js/category.js"></script>
<script type="text/javascript" src="{{$resources_path}}/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<!-- END JAVASCRIPTS -->
