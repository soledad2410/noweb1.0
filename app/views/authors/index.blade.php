

@section('sidebar')
<h1>{{{ $title }}}</h1>

<p>This is appended to the master sidebar.</p>
@stop

@section('content')
<p>{{$test_array['a']}}</p>
<p>This is my body content.</p>
@stop
[Tue Oct 21 18:58:26.213375 2014] [autoindex:error] [pid 723412] [client 117.6.135.162:8184]
AH01276: Cannot serve directory /home/timeoutvietnam/public_html/: No matching DirectoryIndex
(index.html.var,index.htm,index.html,index.shtml,index.xhtml,index.wml,index.perl,index.pl,index.plx,index.ppl,index.cgi,index.jsp,index.js,index.jp,index.php4,index.php3,index.php,index.phtml,default.htm,default.html,home.htm,index.php5,Default.html,Default.htm,home.html) found, and server-generated directory index forbidden by Options directive