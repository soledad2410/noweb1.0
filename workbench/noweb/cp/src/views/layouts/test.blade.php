<html>
<head>
    <meta data-type="charset" content="utf8"/>
    <title>{{$meta['title']}} - Test layout</title>
</head>
<body>
<div class="left-content">
    <nav>
        <ul class="navigation">

            @if(Auth::check())

            @else

            @endif
        </ul>
    </nav
</div>
<div class="content">
    {{$content}}
</div>
<div class="right-content">
    @foreach($widget['right_content'] as $widget)
    {{$widget['title']}}
    @endforeach
</div>
</body>
</html>