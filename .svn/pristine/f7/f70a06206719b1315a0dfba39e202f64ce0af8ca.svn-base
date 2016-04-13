<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue ">
        <ul class="nav nav-tabs">
            <li>
                <a href="/cp/category"><i class="icon-reorder"></i> Danh mục - Trang nội dung website</a>
            </li>
            <li class="active">
                <a href="/cp/category/edit/{{ $category->id }}"><i class="icon-reorder"></i> Danh mục - Trang sửa chuyên mục</a>
            </li>
        </ul>
    </header>
    <div class="row">
        <form method="post" class="form-horizontal tasi-form edit-category-form">
            <div class="col-lg-12">
                <section class="panel taskbar">
                    <header class="panel-heading text-right">
                        <span class="taskbar-title"><i class="icon-reorder"></i> Sửa danh mục: {{$category->name}}</span>
                        <input type="hidden" id="cate_id" name="id" value="{{$category->id}}" />
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
                                <input type="text" value="{{ $category->name }}" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Slug</label>
                            <div class="col-sm-8">
                                <input type="text" value="{{ $category->slug }}" class="form-control" name="slug" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Danh mục cha</label>
                            <div class="col-sm-8">
                                <select name="parent_id" class="form-control category-tree" data-value="{{ $category->parent_id }}">
                                    <option value="0">Danh mục gốc</option>
                                    {{$selectTree}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Trang</label>
                            <div class="col-sm-8">
                                <select name="type" class="form-control" id="cate-type" data-value="{{$category->type}}">
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
                                        <textarea class="form-control" name="description" rows="6">{{$category->description}}</textarea>
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
                                        <input type="checkbox" value="1" name="status" @if ($category->status)
                                        checked
                                        @endif>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Hiện trên menu</label>
                            <div class="col-lg-8">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="show_menu" @if ($category->show_menu)
                                        checked
                                        @endif>
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
                                        <img alt="" src="@if ($category->image)
                                        {{ $category->image }}
                                        @else
                                        http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image
                                        @endif">
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
                                        <textarea name="meta_keyword" class="form-control">{{ $category->meta_keyword }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 col-sm-4 control-label">Meta description</label>
                                    <div class="col-sm-8">
                                        <textarea name="meta_desc" class="form-control">{{ $category->meta_desc }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script type="text/javascript" src="{{$resources_path}}/js/jquery.rowsorter.js"></script>
    <script type="text/javascript" src="{{$resources_path}}/js/category.js"></script>