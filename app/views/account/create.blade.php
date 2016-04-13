<h1>Create account page</h1>

<form action="{{URL::route('account-create-post')}}" method="post">
    <div class="field">
        <label>User name</label>
        <div class="input"><input type="text" name="username"  value="{{Input::old('username')}}" /></div>
        @if($errors->has('username'))
            <span class="error">{{$errors->first('username')}}</span>
        @endif
    </div>
    <div class="field">
        <label>Email</label>
        <div class="input"><input type="text" name="email" value="{{Input::old('email')}}" /></div>
        @if($errors->has('email'))
        <span class="error">{{$errors->first('email')}}</span>
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
        <label>Re Type Password</label>
        <div class="input"><input type="password" name="re_password" value="{{Input::old('re_password')}}"/></div>
        @if($errors->has('re_password'))
        <span class="error">{{$errors->first('re_password')}}</span>
        @endif
    </div>
    <input type="submit" value="create account"/>
    {{Form::token()}}
</form>