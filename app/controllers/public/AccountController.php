<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 11/6/14
 * Time: 9:30 AM
 */

Class AccountController extends PublicController{


    public  function getCreate() {
        $this->layout->meta = array('title' => 'Create account page') ;
        $this->layout->content = View::make('account.create');
    }

    public  function postCreate() {

        $validator = Validator::make(Input::all(),array(
                'email'         => 'required|max:50|email|unique:users',
                'username'      => 'required|max:20|min:6|unique:users',
                'password'      => 'required|min:6',
                're_password'   => 'required|same:password'
            ));

        if($validator->fails()){
            return Redirect::Route('account-create')->withErrors($validator)->withInput();
        }

        /** Create new user */

        $code = md5(rand(0,1));

        $user = User::create(array(
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'code' => $code,
            'active' => 0
        ));

        if($user){
            Mail::send('emails.auth.active', array('link' => URL::route('account-active',$user->code),'username'=>$user->username), function($message) use ($user) {
                 $message->to($user->email,$user->username)->subject('Active your account');
            });
            return Redirect::route('home')->with('global','Your account has been created!, we have sent you an email to the your email address');
        }
    }

    public  function getActive($code){

        $user = User::where('code','=',$code)->where('active','=',0);

        if($user->count()){
            $user = $user->first();
            /** Update user */
            $user->active   = 1;
            $user->code     = '';
            if($user->save()){
                return Redirect::route('home')->with('global','Your account has been actived');
            }

            return Redirect::route('home')->with('global','We could not active your account');
        }

        return Redirect::route('home')->with('global','We could not active your account');

    }

    public function getLogin(){


        $this->layout->title ='Login page';
        $this->layout->content = View::make('account.login');

    }

    public  function postLogin(){
        $this->layout= null;
        $validator = Validator::make(Input::all(),array(
            'username' => 'required|min:6',
            'password' => 'required|min:5'
        ));
        if($validator->fails()){
            return Redirect::route('account-login-post')->withErrors($validator)->withInput();
        } else{
            $remember = Input::has('remember_me') ? true : false;
            $auth = Auth::attempt(array(
               'username' => Input::get('username'),
               'password' => Input::get('password'),
                'active' => 1
            ),$remember);
            if($auth){
                $user = User::find(Auth::user()->id);
                $user->status = 1;
                $user->save();
                return Redirect::intended('/')->with('global','You logged on!');
            }
            return Redirect::route('account-login')->with('global','There was problem logging, user name/password wrong or your account');
        }

    }

    public  function getLogout(){
        $this->layout = null;
        $user = User::find(Auth::user()->id);
        $user->status = 0;
        $user->save();
        Auth::logout();
        return Redirect::route('home')->with('global','You has been logged out!');
    }

    public  function getChangePassword() {
        $this->layout->title = 'Change password page';
        $this->layout->content = View::make('account.password');

    }

    public  function postChangePassword() {
        $this->layout = null;
        $validator = Validator::make(Input::all(),array(
            'old_password' =>  'required',
            'new_password' => 'required|min:6',
            're_password' => 'required|same:new_password'
        ));

        if($validator->fails()){
            return Redirect::route('account-change-password')->withErrors($validator)->withInput();
        }else{

            $user = User::find(Auth::user()->id);
            $old_password = Input::get('old_password');
            $password = Input::get('new_password');

            if(Hash::check($old_password, $user->getPassword())){
                // Password provided matches!
                $user->password = Hash::make($password);

                // Change password
                if($user->save()){
                 return Redirect::route('home')->with('global','Your password has been changed!');
                }
            }
            return Redirect::route('account-change-password')->with('global','Your old password incorrect');
        }
    }
}

