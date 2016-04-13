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
                        <li>
                            <a href="/cp/product/create"><i class="icon-calendar"></i> Thêm mới sản phẩm</a>
                        </li>
                        <li class="active">
                            <a href="javascript:;"><i class="icon-pencil"></i> Sửa chi tiết sản phẩm</a>
                        </li>
                        <li class="">
                            <a href="/cp/inventory/statistics"><i class="icon-bar-chart"></i> Thống kê báo cáo</a>
                        </li>
                    </ul>
                </header>
                <div class="row">
                    <form method="post" class="form-horizontal tasi-form" id="product-edit-form">
                        <div class="col-lg-8">
                            <section class="panel">

                                <header class="panel-heading">
                                    Sửa chi tiết sản phẩm: <strong>{{ $product->name }}</strong>
                                </header>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Tên </label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{ $product->name }}" class="form-control" name="name" required>
                                            <input type="hidden" name="id" value="{{$product->id}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Mã</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$product->code}}" class="form-control" name="code" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Slug</label>
                                        <div class="col-sm-8">
                                            <input type="text" value="{{$product->slug}}" class="form-control" name="slug" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Brief</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" rows="6" name="brief">{{$product->brief}}</textarea>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea class="form-control" name="content" rows="6">{{$product->content}}</textarea>
                                            <script type="text/javascript">
                                                initCKeditor('content');
                                            </script>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                                            <button type="submit" class="btn btn-success publish-news"><i class="icon-ok"></i> Cập nhật</button>
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
                                                    <input type="text" class="form-control currency-field" name="price" value="{{$product->price}}" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Hiển thị</label>
                                        <div class="col-lg-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="show_hot" {{isset($product->show_hot) ? 'checked' : '';}}> Sản phẩm hot
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1" name="comment_allowed" {{isset($product->comment_allowed) ? 'checked' : '';}}> Được bình luận
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
                                            <input type="hidden" name="image" id="image" value="{{$product->thumbnail or ''}}"/>
                                            <div data-provides="fileupload" class="fileupload fileupload-new">
                                                <div class="fileupload-new thumbnail" id="image-thumb">
                                                    <img alt="" src="{{isset($product->thumbnail) && trim($product->thumbnail) != '' ? $product->getThumbnail() : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';}}">
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
<script type="text/javascript" src="{{$resources_path}}/js/product.js"></script>
