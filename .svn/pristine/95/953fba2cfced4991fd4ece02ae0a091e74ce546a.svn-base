<h1>Login page</h1>

@if(Session::has('global'))
<p>{{Session::get('global')}}</p>
@endif
<form action="{{URL::route('account-login-post')}}" method="post">
    <div class="field">
        <label>User name</label>
        <div class="input"><input type="text" name="username"  value="{{Input::old('username')}}" /></div>
        @if($errors->has('username'))
        <span class="error">{{$errors->first('username')}}</span>
        @endif
    </div>

    <div class="field">
        <label>Password</label>
        <div class="input"><input type="password" name="password" value="{{Input::old('password')}}"/></div>
        @if($errors->has('password'))
        <span class="error">{{$errors->first('password')}}</span>
        @endif
    </div>
    <div class="field">
        <label>Remember me</label>
        <div class="input"><input type="checkbox" name="remember_me" value="1"/></div>

    </div>
    <input type="submit" value="create account"/>
    {{Form::token()}}
</form>