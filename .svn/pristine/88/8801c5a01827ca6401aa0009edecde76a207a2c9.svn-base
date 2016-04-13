<section>
    <section class="panel">
        <header class="panel-heading tab-bg-dark-navy-blue ">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="/cp/news" ><i class= "icon-home"></i> Tin tức</a>
                </li>
                <li class="">
                    <a href="/cp/category?type=news"><i class="icon-reorder"></i> Chuyên mục tin</a>
                </li>
                <li class="">
                    <a href="/cp/news/comments"><i class="icon-comments"></i> Bình luận</a>
                </li>
            </ul>
        </header>
        <div class="panel-body">
            <nav role="navigation">
                <div class="form-group text-right">
                    <a href="/cp/news#news-create-form"> <button class="btn btn-info btn-sm" type="button"><i class="icon-plus"></i> Thêm mới</button></a>
                </div>
            </nav>
        </div>
    </section>
    <div class="row">
        <form method="post" class="form-horizontal tasi-form" id="news-edit-form" action="">
            <div class="col-lg-8">
                <section class="panel">

                    <header class="panel-heading">
                      Sửa thông tin bài viết
                  </header>
                  <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tiêu đề</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$newsCache->name or ''}}" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Slug</label>
                        <div class="col-sm-8">
                            <input type="text" value="{{$newsCache->slug or ''}}" class="form-control" name="slug" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Brief</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="6" name="brief">{{$newsCache->brief or ''}}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$newsCache->id or ''}}"/>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" name="content" rows="6">{{$newsCache->content or ''}}</textarea>
                            <script type="text/javascript">
                                initCKeditor('content');
                            </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="button" class="btn btn-default"><i class="icon-refresh"></i> Làm lại</button>
                            <button type="submit" class="btn btn-success"><i class="icon-ok"></i> Lưu </button>
                            <button type="button" class="btn btn-success draft-news-preview"><i class="icon-eye-open"></i> Xem trước</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-4">
            <section class="panel">
                <header class="panel-heading">
                    Tùy chọn bài viết
                </header>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Hiển thị</label>
                        <div class="col-lg-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="show_home" {{$newsCache->show_home == 1 ? 'checked' : '';}}> Trang chủ
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="show_hot" {{$newsCache->show_hot == 1 ? 'checked' : '';}}> Tin hot
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="comment_allowed" {{$newsCache->comment_allowed == 1 ? 'checked' : '';}}> Được bình luận
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label col-lg-4">Chuyên mục</label>
                        <div class="col-lg-8 tree-view" style="max-height: 180px;overflow-y: scroll">
                            {{$checkboxTreeView}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label col-lg-4">Ảnh đại diện</label>
                        <div class="col-lg-8">
                            <input type="hidden" name="thumbnail" id="thumbnail" value="{{$newsCache->thumbnail or ''}}"/>
                            <div data-provides="fileupload" class="fileupload fileupload-new">
                                <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail" id="thumbnail-thumb">
                                    <img alt="" src="{{isset($newsCache->thumbnail) && trim($newsCache->thumbnail) != '' ? $newsCache->thumbnail : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';}}">
                                </div>
                                <div>
                                 <span class="btn btn-white btn-file">
                                     <span class="fileupload-new get-thumbnail"><i class="icon-paper-clip"></i> Select image</span>
                                 </span>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <label class="col-sm-4 control-label col-lg-4">Thời gian xuất bản</label>
                    <div class="col-lg-8">
                        <input name="published_time" class="form-control datetime-picker" value="{{$newsCache->published_time or date('H:i d-m-Y')}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label col-lg-4">Thời gian hết hạn</label>
                    <div class="col-lg-8">
                        <input name="expire_time" class="form-control datetime-picker" value="{{$newsCache->expire_time or ''}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label col-lg-6">Tin tức liên quan <a href="#related-news-table" data-toggle="modal" > <i style="cursor: pointer" class="icon-plus "></i> </a></label>

                </div>
                <div class="form-group">
                    <input type="hidden" id="related_news" name="related_news" value="{{$newsCache->related_news or ''}}">
                    <div class="col-lg-12" id="news-related-list">
                        @foreach($relatedNews as $news)
                        <p data-value="{{$news->id}}"><a onclick="removeRelateNews(this)" data-value="{{$news->id}}" href="javascript:;" title="Xóa khỏi danh sách"> <i class="icon-minus"></i></a>{{$news->name}}
                            <a href="javascript:;">
                                @if($news->status == 0)
                                <i class="icon-archive"></i> Lưu nháp
                                @endif
                                @if($news->status == 1)
                                <i class="icon-ok"></i> Đã đăng
                                @endif
                                @if($news->status == 2)
                                <i class="icon-circle-arrow-down"></i> Đã hạ
                                @endif
                            </a>
                        </p>
                        @endforeach
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
                                <textarea name="meta_keyword" class="form-control">{{$newsCache->meta_keyword or ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">Meta description</label>
                            <div class="col-sm-8">
                                <textarea name="meta_description" class="form-control">{{$newsCache->meta_description or ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 col-sm-4 control-label">Meta h1</label>
                            <div class="col-sm-8">
                                <textarea name="meta_h1" class="form-control">{{$newsCache->meta_h1 or ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label col-lg-4">Tags bài viết <a href="#tags-table" data-toggle="modal" > <i style="cursor: pointer" class="icon-plus "></i> </a></label>
                            <div class="col-lg-8">
                                <div class="panel-body" style="border:1px solid #e2e2e4;border-radius: 5px;overflow-y: scroll;max-height:200px" id="selected-tags">
                                    @foreach($selectedTags as $tag)
                                    <a data-value="{{$tag->id}}" href="javascript:;" class="btn btn-default btn-sm tag-item-remove" style="margin:5px"><i class="icon-minus"></i> {{$tag->name}}</a>
                                    @endforeach
                                </div>
                                <input type="hidden" name="tags" value="{{implode('|', $newsCache->getTagIds())}}"/>

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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="related-news-table" class="modal fade">
    <div class="modal-dialog">,
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Chọn tin tức</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="pull-right" style="margin-bottom: 15px">
                        <form role="form" class="form-inline form-ajax-list-news">
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="sr-only">Chuyên mục</label>
                                <select name="category_id" class="form-control input-sm">
                                    <option value="all">Tất cả</option>
                                    <option value="0">Chưa phân loại</option>
                                </select>
                            </div>
                            <input type="hidden" id="ajax_category_id">
                            <input type="hidden" id="ajax_keyword">
                            <div class="form-group">
                                <label class="sr-only">Từ khóa</label>
                                <input type="text" placeholder="Từ khóa" name="keyword" class="form-control input-sm">
                            </div>
                            <button class="btn btn-success  btn-sm" type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                    <input type="hidden" id="per-page" value="{{\Input::get('per-page') or 10}}"/>
                    <table cellspacing="0" cellpadding="0" border="0"  class="display table-hover table table-bordered dataTable news-list-table-compact" id="news-list-table-compact" >
                        <thead>
                            <tr role="row">
                                <td class="center w5"></td>
                                <td class="sort sorting w25">Tiêu đề</td>
                                <td class="center w15">Người đăng</td>
                                <td class="w15">#</td>
                            </tr>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            @foreach($newssAjax as $news)
                            <tr rel="{{$news->id}}" {{in_array($news->id,explode('|',$newsCache->related_news)) ? 'class="selected"' : '';}}>
                                <td class="center"><input type="checkbox" name="id[]" value="{{$news->id}}" {{in_array($news->id,explode('|',$newsCache->related_news)) ? 'checked' : '';}}></td>
                                <td class="title" >{{$news->name}}</td>
                                <td class="center">{{$news->user->username}}</td>
                                <td class="status"><a  href="javascript:;">
                                    @if($news->status == 0)
                                    <i class="icon-archive"></i> Lưu nháp
                                    @endif
                                    @if($news->status == 1)
                                    <i class="icon-ok"></i> Đã đăng
                                    @endif
                                    @if($news->status == 2)
                                    <i class="icon-circle-arrow-down"></i> Đã hạ
                                    @endif
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="dataTables_info"> Hiển thị <strong id="ajax-from">{{$range['from']}}</strong> - <strong id="ajax-to">{{$range['to']}}</strong> / <strong id="ajax-total">{{$range['totalRecord']}}</strong> bản ghi</div></div>
                        <div class="col-lg-7">
                            <div class="dataTables_paginate paging_bootstrap pagination ajax-paginator">{{$ajaxPaginator}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TAGS FORM TABLE -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="tags-table" class="modal fade">
    <div class="modal-dialog">,
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Chọn Tags từ danh sách</h4>
            </div>
            <div class="modal-body">
                <div class="panel-body" id="list-tags" style="border: 1px solid #eee;border-radius:5px ">
                    @foreach($tags as $tag)
                    <a style="margin:5px" class="btn btn-default btn-sm tag-item" href="javascript:;" data-value="{{$tag->id}}"><i class="icon-plus"></i> {{$tag->name}}</a>
                    @endforeach
                </div>
                <div class="panel-body " style="border: 1px solid #eee;border-radius:5px ">
                <form action="" method="POST" id="add-tag-form">
                    <h4>Thêm tag mới</h4>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" value="" placeholder="Nhập tên tag" />
                        <input type="hidden" name="slug" value="">
                    </div>
                    <button class="btn btn-sm btn-primary" id="btn_modal_add_tag" type="submit">Thêm</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END JAVASCRIPTS -->
<script type="text/javascript" src="{{$resources_path}}/js/news.js"></script>
<script type="text/javascript" src="{{$resources_path}}/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>