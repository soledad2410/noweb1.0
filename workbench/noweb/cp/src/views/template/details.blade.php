<section class="panel">
    <header class="panel-heading tab-bg-dark-navy-blue wht-color">Giao diện website</header>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4">
            <figure>
                <img src="{{getThemeDir()}}default/thumb.png" class="img-responsive"/>
                </figure>
            </div>
            <div class="col-lg-8 text-left">
                <h1>{{$themeInfo['title']}}</h1>
                    <h6>Date created: <strong>{{$themeInfo['date']}}</strong></h6>
                    <h6>Copyright: <strong>{{$themeInfo['copyright']}}</strong></h6>
                    <h6>Type: <strong>{{$themeInfo['type']}}</strong></h6>
                <article>
                    {{$themeInfo['description']}}
                </article>
                <br><br>
                <button class="btn btn-success" ><i class="icon-ok"></i> Cài đặt</button>
                <button class="btn btn-default" ><i class="icon-ok"></i> Đã cài đặt</button>

            </div>
        </div>
    </div>
</section>

<section >
    <header class="panel-heading tab-bg-dark-navy-blue wht-color">
        Vị trí và khối nội dung website
    </header>
    <div class="panel-body">
        <div class="row">
                  @foreach($positions as $pos)
      <div class="col-lg-4">
                      <section class="panel">
                          <header class="panel-heading">
                              {{$pos['title']}}
                              <a href="javascript:;" onclick="addWidget()" ><i class="icon-plus pull-right"> Thêm</i></a>
                          </header>
                          <ul class="list-group">

                          </ul>
                      </section>
                  </div>
            @endforeach;
        </div>
    </div>
</section>

<form id="add-widget" method="post" style="display: none">
                        <div class="form-group">
                            <label>Tiêu đề khối</label>
                            <input type="text"  placeholder="name" name="name" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label>Vị trí</label>
                            <select name="position" class="form-control">
                            @foreach($positions as $pos)
                            <option value="{{$pos['name']}}">{{$pos['title']}}</option>
                            @endforeach;
                            </select>
                        </div>
                        <input type="hidden" name="id"/>
                        <div class="form-group">
                            <label>Loại khối </label>
                            <select name="position" class="form-control" id="position">
                                <option>Chọn loại khối</option>
                                @foreach($widgetTypes['widget'] as $type)
                                <option value="{{$type['name']}}">{{$type['title']}}</option>
                                @endforeach;
                            </select>
                        </div>
                       <div class="form-group" id="widget-config">

                        </div>
                        <button class="btn btn-success" type="submit"><i class="icon-ok"></i>Lưu</button>
                        <button class="btn btn-default" type="button"><i class="icon-refresh"></i>Làm lại</button>
</form>
<script type="text/javascript" src="{{$resources_path}}/js/theme.js"></script>