<link rel="stylesheet" type="text/css" href="{{$resources_path}}/css/gallery.css" />
<link rel="stylesheet" type="text/css" href="{{$resources_path}}/assets/fancybox/source/jquery.fancybox.css" />
<section>
    <header class="panel-heading tab-bg-dark-navy-blue" style="margin-bottom: 10px;">
        <ul class="nav nav-tabs">

            <li>
                <a href="/cp/gallery"><i class="icon-reorder"></i> Danh sách album</a>
            </li>
            <li class="active">
                <a href="/cp/gallery/album/{{$gallery_id}}"><i class="icon-reorder"></i> Danh sách ảnh trong album</a>
            </li>

        </ul>
    </header>
    <div class="row">
        <div class="col-md-3">
            <section class="panel">
                <header class="panel-heading">
                    Thêm ảnh vào album
                </header>
                <div class="panel-body">
                    <form role="form" id="add-media" method="post">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input required="" type="text" placeholder="name" name="name" class="form-control" onkeyup="slugify(this)">
                            <input type="hidden" name="gallery_id" value="{{$gallery_id}}">
                            <input type="hidden" name="status" value="1">
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn</label>
                            <input required="" type="text" placeholder="slug" name="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Ảnh</label>
                            <input type="hidden" name="image" id="image" value=""/>
                            <div data-provides="fileupload" class="fileupload fileupload-new">
                            <div class="fileupload-new thumbnail" id="image-thumb">
                                <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                            </div>
                            <div>
                            <span class="btn btn-white btn-file">
                                <span onclick="browserImageFile('image')" class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                            </span>
                        </div>
                        <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                        <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
                    </form>
                </div>
          </section>
      </div>
      <div class="col-md-9">
        <section class="panel">
            <div role="grid" class="dataTables_wrapper table-responsive">
                <form action="" method="get" class="form-inline navbar-right" role="form">
                    <div class="form-group">
                        <select data-value="{{\Input::get('status')}}" name="status" class="form-control input-sm" >
                            <option value="all">Tất cả trạng thái</option>
                            <option value="0">Chờ duyệt</option>
                            <option value="1">Đã đăng</option>
                            <option value="2">Đã hạ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control input-sm search-input" placeholder="Từ khóa" name="keyword" value="{{\Input::get('keyword')}}">
                    </div>
                    <button type="submit" class="btn btn-success input-sm">Tìm</button>
                </form>
                {{-- <button class="btn btn-danger btn-sm remove pull-left" type="button"><i class="icon-remove"></i> Xóa</button> --}}
            </div>
            <form id="media-list">
                <ul class="grid cs-style-3">
                    @foreach ($medias as $item)
                    <li data-rel="{{$item['id']}}">
                        <figure>
                            <a rel="gallery" class="fancybox" href="{{$item->getThumbnailUrl($item['thumbnail'])}}"><img alt="{{$item['name']}}" src="{{$item->getThumbnailUrl($item['thumbnail'])}}"></a>
                            <figcaption>
                                <h3>{{$item['name']}}</h3>
                                <span>{{$item['description']}}</span>
                                <a href="javascript:;" rel="group" class="btn btn-sm btn-info btn-edit">Sửa</a>
                                <a href="javascript:;" rel="group" class="btn btn-sm btn-danger btn-delete">Xóa</a>
                            </figcaption>
                        </figure>
                    </li>
                    @endforeach
                </ul>
            </form>
            <div class="row">
                <div class="col-lg-5">
                    <div class="dataTables_info"> Hiển thị <strong id="ajax-from">{{$range['from']}}</strong> - <strong id="ajax-to">{{$range['to']}}</strong> / <strong id="ajax-total">{{$range['totalRecord']}}</strong> bản ghi</div></div>
                    <div class="col-lg-7">
                        <div class="dataTables_paginate paging_bootstrap pagination ajax-paginator">{{$paginator}}</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</section>

{{-- Edit form --}}
<form role="form" id="edit-media" method="post" style="display: none">
    <div class="row">
        <div class="form-group col-md-12">
            <label>Tiêu đề</label>
            <input required="" type="text" placeholder="name" name="name" class="form-control" onkeyup="slugify(this)">
            <input type="hidden" name="gallery_id" value="{{$gallery_id}}">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="status" value="1">
        </div>
        <div class="form-group col-md-12">
            <label>Đường dẫn</label>
            <input required="" type="text" placeholder="slug" name="slug" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label>Ảnh</label>
            <input type="hidden" name="image" id="edit-image" value=""/>
            <div data-provides="fileupload" class="fileupload fileupload-new">
                <div class="fileupload-new thumbnail" id="edit-image-thumb">
                    <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                </div>
                <div>
                    <span class="btn btn-white btn-file">
                        <span onclick="browserImageFile('edit-image')" class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group col-md-8">
            <label>Mô tả</label>
            <textarea rows="7" name="description" class="form-control"></textarea>
        </div>
    </div>
    <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
    <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
</form>
{{-- /Edit form --}}

<script type="text/javascript" src="{{$resources_path}}/js/media.js"></script>
<script type="text/javascript" src="{{$resources_path}}/assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="{{$resources_path}}/assets/fancybox/source/jquery.fancybox.js"></script>
<script>
    $(document).ready(function() {
        $("a.fancybox").fancybox();
    });
</script>