<div class="page-head">
	<h1><a href="{{$url->get_news_url($news)}}">{{$news->name}}</a></h1>
	<span class="datetime">({{dateFormat($news->published_time)}})</span>
</div>
<div class="page-body">
	{{$news->content}}
</div>
<div class="social">

</div>
<div class="related-posts">
	<div class="title">Tin liên quan</div>
	<ul class="list-news">
		@foreach ($relatedNews as $item)
		<li>
			<i class="icon icon-arrow-right"></i>
			<a href="{{$url->get_news_url($item)}}">{{$item->name}}<span class="date">({{dateFormat($news->published_time)}})</span></a>
		</li>
		@endforeach
	</ul>
</div>