<html>
<head>
    <meta data-type="charset" content="utf8"/>
    <title>{{$meta['title']}}</title>
</head>
<body>
<div class="left-content">
<nav>
    <ul class="navigation">
        <li><a href="{{URL::Route('home')}}">Home</a></li>
        @if(Auth::check())
        <li><a href="{{URL::Route('user-profile',Auth::user()->username)}}">Profile</a> </li>
        <li><a href="{{URL::Route('account-logout')}}">Logout</a> </li>
        <li><a href="{{URL::Route('account-change-password')}}">Change password</a> </li>
        @else
        <li><a href="{{URL::Route('account-create')}}">Create Account</a></li>
        <li><a href="{{URL::Route('account-login')}}">Login</a></li>
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