<style type="text/css" media="screen">
    .add_widget_type_properties {margin-top: 7px;}
    .group {margin-bottom: 5px;}
</style>
<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue ">
        <ul class="nav nav-tabs">
            <li class="">
                <a href="/cp/widget-type"><i class="icon-home"></i> Danh sách các loại khối</a>
            </li>
            <li class="active">
                <a href="/cp/widget-type/create"><i class="icon-plus"></i> Thêm loại khối mới</a>
            </li>
        </ul>
    </header>
    <div class="panel-body">
        <form action="" method="POST" class="form-horizontal tasi-form" id="add-type-properties">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên loại khối</label>
                        <div class="col-md-10">
                            <input type="text" required="" name="name" class="form-control" value="" placeholder="Tên loại khối">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tiêu đề loại khối</label>
                        <div class="col-md-10">
                            <input type="text" required="" name="title" class="form-control" value="" placeholder="Tiêu đề loại khối">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Mô tả loại khối</label>
                        <div class="col-md-10">
                            <textarea name="description" class="form-control" rows="5" required="" placeholder="Mô tả loại khối"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Thêm cấu hình</label>
                        <div class="col-md-10">
                            <a title="Thêm thuộc tính mới" href="javascript:;" class="btn btn-xs btn-info add_widget_type_properties" data-toggle="tooltip">
                                <i class="icon-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10 form-properties">

                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-default" type="button"><i class="icon-refresh"></i> Làm lại</button>
                        <button class="btn btn-success publish-news" type="submit"><i class="icon-ok"></i> Lưu và xuất bản</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
{{-- Form add properties --}}
<div id="form-properties" style="display: none">
    <div class="properties-content">
        <div class="row">
            <div class="group col-md-12">#<span class="no"></span> <a href="javascript:;" class="pull-right remove-properties" data-toggle="tooltip" title="Xóa thuộc tính này">
                <i class="fa-icon-close"></i>
            </a></div>
            <div class="group col-md-4">
                <input type="text" name="config_title[]" class="form-control" required="" placeholder="Tiêu đề cấu hình. VD: Khối sản phẩm" />
            </div>
            <div class="group col-md-4">
                <input type="text" name="config_name[]" class="form-control" required="" placeholder="Tên cấu hình. VD: product" />
            </div>
            <div class="group col-md-4">
                <select name="field_type[]" class="form-control">
                    <option value="">Loại trường</option>
                    <option value="textbox">textbox</option>
                    <option value="radio">radio</option>
                    <option value="checkbox">checkbox</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="group col-md-12">
                <textarea name="field_value[]" class="form-control" rows="4" required="" placeholder="Giá trị. VD: Mới nhất:latest,Sản phẩm hot:hot"></textarea>
            </div>
        </div>
    </div>
</div>
{{-- /Form add properties --}}
<!--script for this page only-->
<script type="text/javascript" src="{{$resources_path}}/js/widget-type.js"></script>