<section>
    <!-- page start-->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading tab-bg-dark-navy-blue ">
                    <ul class="nav nav-tabs">
                        <li class="">
                            <a href="/cp/product"><i class="icon-home"></i> Sản phẩm website </a>
                        </li>
                        <li class="active">
                            <a href="/cp/product/create"><i class="icon-calendar"></i> Thêm mới sản phẩm</a>
                        </li>
                        <li class="">
                            <a href="/cp/product/review"><i class="icon-bar-chart"></i> Đánh giá của sản phẩm</a>
                        </li>
                    </ul>
                </header>
                <div class="row">
                    <form method="post" class="form-horizontal tasi-form" id="product-create-form">
                        <div class="col-lg-8">
                            <section class="panel">

                                <header class="panel-heading">
                                    Thêm mới sản phẩm
                                </header>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Tên </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$cache->name or ''}}" class="form-control" name="name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Mã</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$cache->code or ''}}" class="form-control" name="code" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Slug</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$cache->slug or ''}}" class="form-control" name="slug" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Brief</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" rows="6" name="brief">{{$cache->brief or ''}}</textarea>
                                        </div>
                                    </div>

                                    @if (count($ppArray))
                                    @foreach ($ppArray as $pp)
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">{{$pp->title}}</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" rows="6" name="{{$pp->product_var}}"></textarea>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif


                                    <div class="form-group">
                                        <label class="col-sm-12 control-label">Chi tiết</label>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="content" rows="6">{{$cache->content or ''}}</textarea>
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
                                    Tùy chọn sản phẩm
                                </header>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Giá(vnđ)</label>
                                        <div class="col-lg-8">
                                            <div class="input">
                                                <label>
                                                    <input type="text" class="form-control currency-field" name="price"/>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Hiển thị</label>
                                        <div class="col-lg-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="show_hot" {{isset($cache->show_hot) ? 'checked' : '';}}> Sản phẩm hot
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="comment_allowed" {{isset($cache->comment_allowed) ? 'checked' : '';}}> Được bình luận
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-4">Chuyên mục</label>
                                        <div class="col-lg-8 tree-view" style=";max-height: 180px;overflow-y: scroll">
                                            {{$radioTreeView}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label col-lg-4">Ảnh đại diện</label>
                                        <div class="col-lg-8">
                                            <input type="hidden" name="image" id="image" value="{{$cache->thumbnail or ''}}"/>
                                            <div data-provides="fileupload" class="fileupload fileupload-new">
                                                <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail" id="image-thumb">
                                                    <img alt="" src="{{isset($cache->thumbnail) && trim($cache->thumbnail) != '' ? $cache->thumbnail : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';}}">
                                                </div>
                                                <div>
                                                 <span class="btn btn-white btn-file">
                                                     <span onclick="browserImageFile('image')" class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
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
                                                <textarea name="meta_keyword" class="form-control">{{$cache->meta_keyword or ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 col-sm-4 control-label">Meta description</label>
                                            <div class="col-sm-8">
                                                <textarea name="meta_desc" class="form-control">{{$cache->meta_desc or ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-4 col-sm-4 control-label">Meta h1</label>
                                            <div class="col-sm-8">
                                                <textarea name="meta_h1" class="form-control">{{$cache->meta_h1 or ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                            <label>Tên</label>
                            <input type="text" placeholder="Tên danh  mục" name="name"  class="form-control" required="">
                            <input type="hidden" name="slug" value="" />
                            <input type="hidden" name="status" value="1" />
                            <input type="hidden" name="type" value="product" />
                        </div>

                        <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
                        <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add catalogue modal form -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="add-brand" class="modal fade">
    <div class="modal-dialog">,
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Thêm mới thương hiệu sản phẩm</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form role="form" class="brand-form" method="post" id="brand-form">
                        <div class="form-group col-lg-6">
                            <?php var_dump($_SESSION['ck']);?>
                            <label>Tên</label>
                            <input type="text" placeholder="Tên thương hiệu" name="name"  class="form-control" required="">
                        </div>
                        <input type="hidden" name="id"/>
                        <div class="form-group col-lg-6">
                            <label>Logo</label>
                            <input type="hidden" name="logo" id="brandlogo" >
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div id="brandlogo-thumb" class="fileupload-new brandlogo" style="height: 120px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" height="120px">
                                </div>
                                <div>
                                 <span class="btn btn-white btn-file">
                                     <span class="fileupload-new get-thumbnail"><i class="icon-paper-clip"></i> Select image</span>
                                 </span>
                             </div>
                         </div>
                     </div>
                     <div class="form-group col-lg-6">
                        <label>Thông tin liên hệ</label>
                        <textarea class="form-control" name="contact_info"></textarea>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Chú thích</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
                    <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                    <button type="button" class="btn btn-danger delete-brand" style="display: none"><i class="icon-remove"></i> Xóa</button>
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
        <input type="text" placeholder="Tên danh  mục" name="name"  class="form-control" required="">
    </div>
    <input type="hidden" name="id" />
    <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
    <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
    <button type="button" class="btn btn-danger delete-catalogue"><i class="icon-remove"></i> Xóa</button>
</form>

<!-- Add product modal form -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="add-product" class="modal fade">
    <div class="modal-dialog">,
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Thêm mới chủng loại hàng hóa</h4>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <form role="form" class="product-form" method="post" id="product-form">
                        <div class="form-group col-lg-6">
                            <label>Mã <span class="require"> (*)</span></label>
                            <input type="text"  name="code"  class="form-control" required="">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Tên <span class="require">(*)</span></label>
                            <input type="text"  name="name"  class="form-control" required="">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Trọng lượng (gam)</label>
                            <input type="text"  name="weight"  class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Kích thước</label>
                            <input type="text"  name="size"  class="form-control">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Ảnh</label>
                            <input type="hidden" name="img" id="prodimg" >
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div id="prodimg-thumb" class="fileupload-new" style="height: 120px;">
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" height="120px">
                                </div>
                                <div>
                                 <span class="btn btn-white btn-file">
                                     <span class="fileupload-new get-prodimg"><i class="icon-paper-clip"></i> Select image</span>
                                 </span>
                             </div>
                         </div>
                     </div>
                     <div class="form-group col-lg-6">
                        <label>Thương hiệu</label>
                        <select name="brand_id" class="form-control">
                            <option value="0">Không phân loại</option>
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Danh mục</label>
                        <select name="cat_id" class="form-control">
                            <option value="0">Không phân loại</option>
                            @foreach($catalogues as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Màu sắc</label>
                        <input type="text" name="color" class="form-control"/>
                    </div>
                    <div class="form-group col-lg-3">
                        <label>Đơn vị</label>
                        <input type="text" name="unit" class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="icon-ok"></i>Xác nhận</button>
                    <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="{{$resources_path}}/js/product.js"></script>
