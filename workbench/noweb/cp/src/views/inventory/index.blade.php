<style type="text/css">
    .pro-img-box{width:330px;height: 263px;position: relative}
    .pro-img-box img{max-width: 330px;max-height: 263px;position: absolute;top: 0;left: 0;right: 0;bottom: 0;margin:auto}
</style>

<section class="wrapper">
    <!-- page start-->
    <div class="row">
        <div class="col-md-3">
            <section class="panel">
                <div class="panel-body">
                    <input type="text" class="form-control" placeholder="Keyword Search">
                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    Danh mục hàng hóa    <a data-toggle="modal" href="#add-catalogue"><i class="icon-plus"></i></a>
                </header>
                <div class="panel-body">
                    <ul class="nav prod-cat">
                        @foreach($catalogues as $cat)
                        <li><a style="width: 80%" class="pull-left" href="/cp/inventory?cat={{$cat->id}}"><i class="icon-angle-right"></i> {{$cat->name}}</a> <a href="javascript:;" class="pull-right edit-catalogue" title="{{$cat->name}}" data-value="{{$cat->id}}">  <i class="icon-edit"></i></a></li>
                        @endforeach
                    </ul>
                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    Thương hiệu    <a data-toggle="modal" href="#add-brand"><i class="icon-plus"></i></a>
                </header>
                <div class="panel-body">
                    <div class="best-seller">
                        @foreach($brands as $brand)
                        <article class="media">
                            <a class="pull-left thumb p-thumb">
                                <img src="{{$brand->getLogo()}}">
                            </a>
                            <div class="media-body">
                                <a class="p-head" href="javascript:;" onclick="filterByBrand({{$brand->id}})">{{$brand->name}}</a>
                            </div>
                            <a href="javascript:;" class="pull-right" onclick="showEditBrandForm({{$brand->id}})" title="{{$brand->name}}" >  <i class="icon-edit"></i></a>
                        </article>
                        @endforeach

                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-9">
            <section class="panel">
                <header class="panel-heading tab-bg-dark-navy-blue ">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="/cp/inventory"><i class="icon-home"></i> Sản phẩm kho </a>
                        </li>
                        <li class="">
                            <a href="/cp/inventory/import"><i class="icon-calendar"></i> Nhập kho sản phẩm</a>
                        </li>
                        <li class="">
                            <a href="/cp/inventory/statistics"><i class="icon-bar-chart"></i> Thống kê báo cáo</a>
                        </li>
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="pro-sort">
                        <label class="pro-lab">Sort By</label>
                        <select class="styled hasCustomSelect" style="width: 133px; position: absolute; opacity: 0; height: 39px; font-size: 12px;">
                            <option>Default Sorting</option>
                            <option>Popularity</option>
                            <option>Average Rating</option>
                            <option>Newness</option>
                            <option>Price Low to High</option>
                            <option>Price High to Low</option>
                        </select><span class="customSelect styled" style="display: inline-block;"><span class="customSelectInner" style="width: 111px; display: inline-block;">Default Sorting</span></span>
                    </div>
                    <div class="pro-sort">
                        <label class="pro-lab">Show</label>
                        <select class="styled hasCustomSelect" style="width: 121px; position: absolute; opacity: 0; height: 39px; font-size: 12px;">
                            <option>Result Per Page</option>
                            <option>2 Per Page</option>
                            <option>4 Per Page</option>
                            <option>6 Per Page</option>
                            <option>8 Per Page</option>
                            <option>10 Per Page</option>
                        </select><span class="customSelect styled" style="display: inline-block;"><span class="customSelectInner" style="width: 99px; display: inline-block;">Result Per Page</span></span>
                    </div>
                    <div class="pull-right" style="margin:4px">
                       <a data-toggle="modal" href="#add-product"> <button type="button" class="btn btn-info btn-sm"><i class="icon-plus"></i> Thêm mới</button></a>
                    </div>
                    <div class="btn-group pull-right" style="margin:4px">
                        <button data-toggle="dropdown" class="btn dropdown-toggle btn-info btn-sm"><i class="icon-list"></i> Tác vụ
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" class="import-excel" ><span class="icon-xls"></span> Thêm từ  file excel</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:;" class="export-excel" resource="news-list-table"><span class="icon-xls"></span>Xuất file excel</a></li>
                        </ul>
                    </div>
                    <div class="pull-right ">

                        <ul class="pagination pagination-sm pro-page-list">

                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            </section>

            <div class="row product-list">
                @foreach($products as $p)

                    <div class="col-md-4">
                        <section class="panel">
                            <div class="pro-img-box">
                                <img alt="{{$p->name}}" src="{{$p->getImg()}}">
                                <a class="adtocart" href="javascript:;">
                                    <i class="icon-shopping-cart"></i>
                                </a>
                            </div>

                            <div class="panel-body text-center">
                                <h4>
                                    <a class="pro-title" href="javascript:;" data-val="{{$p->id}}">
                                        {{$p->name}}
                                    </a>
                                </h4>
                                <p class="price">Sold: {{$p->getTotalSold()}}</p>
                                <p class="price">Avaiable: {{$p->getTotalRemain()}}</p>
                            </div>
                        </section>
                    </div>
                @endforeach
            </div>
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
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" placeholder="Tên danh  mục" name="name"  class="form-control" required="">
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
<script type="text/javascript" src="{{$resources_path}}/js/inventory.js"></script>
