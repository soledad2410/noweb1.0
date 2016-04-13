<div class="list-news">
    @foreach ($news as $item)
    <div class="item row">
        <h6><a href="{{$url->get_news_url($item)}}">{{$item->name}}</a></h6>
        <div class="item-photo col-md-4">
            <a href="{{$url->get_news_url($item)}}"><img width="172" src="{{$url->get_thumbnail($item)}}" alt=""></a>
        </div>
        <div class="item-caption col-md-8">
            <p>{{$item->brief}}</p>
            <p class="readmore"><a href="{{$url->get_news_url($item)}}">Chi tiết &gt;&gt;</a></p>
        </div>
    </div>
    @endforeach
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