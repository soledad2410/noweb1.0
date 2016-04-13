<link rel="stylesheet" type="text/css" href="{{$resources_path}}/assets/nestable/jquery.nestable.css" />
<style type="text/css" media="screen">
    .dd {margin-top: -3px;}
    div#nestable_list_menu {right: -108px;position: absolute;}
</style>
<!-- page start-->
<section class="panel">
    <header class="panel-heading">
        Cây danh mục website
    </header>
    <div class="panel-body">
        <div class="col-md-8">
            <div class="dd" id="nestable_list_1">
                {{$CateTrees}}
            </div>
        </div>
        <div class="action col-md-4" id="nestable_list_menu">
            <button type="button" class="btn btn-success" data-action="expand-all">Mở rộng</button>
            <button type="button" class="btn btn-warning" data-action="collapse-all">Thu gọn</button>
            <button type="button" class="btn btn-primary" data-action="save-change">Lưu</button>
        </div>
    </div>
</section>
<!-- page end-->
<script src="{{$resources_path}}/assets/nestable/jquery.nestable.js"></script>
<script src="{{$resources_path}}/js/nestable.js"></script>