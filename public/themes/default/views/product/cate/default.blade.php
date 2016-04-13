<div id="content" class="content-site">
    <div class="product-cate">
        @foreach ($products as $item)
        <div class="item-product col-md-4 text-center">
            <a class="p-img" href="{{$url->get_product_url($item)}}" title="{{$item->name}}">
                <img src="{{$url->get_thumbnail($item)}}" alt="{{$item->name}}" title="{{$item->name}}">
            </a>
            <a class="p-name" href="{{$url->get_product_url($item)}}" title="{{$item->name}}">
                {{$item->name}}
            </a>
            <p class="p-summary">{{$item->brief}}</p>
        </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-lg-5">
        <div class="dataTables_info"> Hiển thị <strong>{{$range['from']}}</strong> - <strong>{{$range['to']}}</strong> / <strong>{{$range['totalRecord']}}</strong> bản ghi</div>
    </div>
    <div class="page-navigation col-lg-7">
        <div class="paging">
            {{$paginator}}
        </div>
    </div>
</div>