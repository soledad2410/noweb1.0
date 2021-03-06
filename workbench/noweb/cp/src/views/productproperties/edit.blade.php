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
            <li class="">
                <a href="/cp/widget-type/create"><i class="icon-plus"></i> Thêm loại khối mới</a>
            </li>
            <li class="active">
                <a href="/cp/widget-type/edit/{{$item['id']}}"><i class="icon-calendar"></i> Sửa thuộc tính khối</a>
            </li>
        </ul>
    </header>
    <div class="panel-body">
        <form action="" method="POST" class="form-horizontal tasi-form" id="edit-type-properties">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tên loại khối</label>
                        <div class="col-md-10">
                            <input type="text" required="" name="name" class="form-control" value="{{$item['name']}}">
                            <input type="hidden" name="id" value="{{$item['id']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Tiêu đề loại khối</label>
                        <div class="col-md-10">
                            <input type="text" required="" name="title" class="form-control" value="{{$item['title']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Mô tả loại khối</label>
                        <div class="col-md-10">
                            <textarea name="description" class="form-control" rows="3" required="">{{$item['description']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Thêm cấu hình</label>
                        <div class="col-md-10">
                            <a href="javascript:;" class="btn btn-xs btn-info add_widget_type_properties" data-toggle="tooltip" title="Thêm thuộc tính mới">
                                <i class="icon-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label"></label>
                        <div class="col-md-10 form-properties">
                            @foreach ($item['config_name'] as $key => $value)
<div class="properties-content">
    <div class="row">
        <div class="group col-md-12">#<span class="no"></span> <a href="javascript:;" class="pull-right remove-properties" data-toggle="tooltip" title="Xóa thuộc tính này">
            <i class="fa-icon-close"></i>
        </a></div>
        <div class="group col-md-4">
            <input type="text" name="config_title[]" class="form-control" required="" value="{{$item['config_title'][$key]}}" />
        </div>
        <div class="group col-md-4">
            <input type="text" name="config_name[]" class="form-control" required="" value="{{$value}}" />
        </div>
        <div class="group col-md-4">
            <select name="field_type[]" class="form-control" data-value="{{$item['field_type'][$key]}}" required="">
                <option value="">Loại trường</option>
                <option value="textbox">textbox</option>
                <option value="radio">radio</option>
                <option value="checkbox">checkbox</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="group col-md-12">
            <textarea name="field_value[]" class="form-control" rows="2" required="">{{$item['field_value'][$key]}}</textarea>
        </div>
    </div>
</div>
                            @endforeach
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
            <div class="group col-md-12">#<span class="no"></span> <a href="javascript:;" class="pull-right remove-properties" title="Xóa thuộc tính này" data-toggle="tooltip">
                <i class="fa-icon-close"></i>
            </a></div>
            <div class="group col-md-4">
                <input type="text" name="config_title[]" class="form-control" required="" placeholder="Tiêu đề cấu hình. VD: Khối sản phẩm" />
            </div>
            <div class="group col-md-4">
                <input type="text" name="config_name[]" class="form-control" required="" placeholder="Tên cấu hình. VD: product" />
            </div>
            <div class="group col-md-4">
                <select name="field_type[]" class="form-control" required="">
                    <option value="">Loại trường</option>
                    <option value="textbox">textbox</option>
                    <option value="radio">radio</option>
                    <option value="checkbox">checkbox</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="group col-md-12">
                <textarea name="field_value[]" class="form-control" rows="2" required="" placeholder="Giá trị. VD: Mới nhất:latest,Sản phẩm mua nhiều:bestsale"></textarea>
            </div>
        </div>
    </div>
</div>
{{-- /Form add properties --}}
<!--script for this page only-->
<script type="text/javascript" src="{{$resources_path}}/js/widget-type.js"></script>