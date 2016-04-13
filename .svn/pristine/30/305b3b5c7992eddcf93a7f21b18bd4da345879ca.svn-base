<h1>Change password page</h1>
@if(Session::has('global'))
{{Session::get('global')}}
@endif
<form method="post" action="{{URL::route('account-change-password-post')}}">
<div class="fields">
    <div class="field">
        <label for="password">Old password</label>
        <input name="old_password" type="password"/>
        @if($errors->has('old_password'))
        <span class="error">{{$errors->first('old_password')}}</span>
        @endif
    </div>
    <div class="field">
        <label for="new_password">New password</label>
        <input name="new_password" type="password"/>
        @if($errors->has('new_password'))
        <span class="error">{{$errors->first('new_password')}}</span>
        @endif
    </div>
    <div class="field">
        <label for="new_password">Retype new password</label>
        <input name="re_password" type="password"/>
    </div>
    @if($errors->has('re_password'))
    <span class="error">{{$errors->first('re_password')}}</span>
    @endif
    <div class="field">
            <input type="submit" value="Change password"/>
    </div>
    {{Form::token()}}
</div>
</form>