<h1>This's index page</h1>
@if(Session::has('global'))
<p>{{Session::get('global')}}</p>
@endif