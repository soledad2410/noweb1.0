<?php
/**
 * Created by hungls
 * User: hungls
 * Date: 11/26/14
 * Time: 2:51 PM
 * noweb version 1.0
 * Custom filter with acl support
 */
Route::filter('admin', function()
{
    /** Allow only admin and user */
    if (Auth::guest())
    {
        if (Request::ajax())
        {
            return Response::make('Unauthorized', 401);
        }
        else
        {
            return Redirect::to('/cp');
        }
    }
    else
    {
        if (session_id() == '') {
            session_start();
        }
        /** get all modules privileges */
        $acls = \Config::get('cp::acl.modules');
        $routerAction = strtolower(\Route::currentRouteAction());
        list($module,$action) = explode('@',$routerAction);
        /** Module and controller invalid from acl config file, except error controller */
        if($module == 'noweb\cp\errorcontroller')
        {
            return;
        }
        if(!isset($acls[$module]) || !isset($acls[$module][$action])){
            if(Request::ajax()){
                return Response::json(array('code' => '403', 'msg' => 'Forbidden Access'));
            } else{
                return Redirect::route('cp-403');
            }
        }
        /** Check group privileges */
        $config_privileges =  explode('|', $acls[$module][$action]['allows']);
        $group = \Noweb\Cp\User::find(Auth::user()->getAuthIdentifier())->group;
        $group_name = $group->name;
        /** Allow specify group access from acl config file */
        if(in_array('any', $config_privileges) || in_array($group_name, $config_privileges))
        {
            // Acl ckfinder
            $_SESSION['ck']['auth'] = true;
            $_SESSION['ck']['user'] = Auth::user()->username;
            $_SESSION['ck']['uploadDir'] = \Config::get('cp::cp.upload_dir');
            $_SESSION['ck']['privateUserUploadDir'] = \Config::get('cp::cp.userfile_dir');
            $_SESSION['ck']['inventoryUploadDir'] = \Config::get('cp::cp.inventory_dir');
            return;

        }
        /** Check privileges config from database */
        $db_privileges = explode('|', $group->privileges);
        if(in_array($routerAction, $db_privileges))
        {
            $_SESSION['ck']['auth'] = true;
            $_SESSION['ck']['user'] = Auth::user()->username;
            $_SESSION['ck']['uploadDir'] = \Config::get('cp::cp.upload_dir');
            $_SESSION['ck']['privateUserUploadDir'] = \Config::get('cp::cp.userfile_dir');
            return;
        }
        /** Don't have any role match config acl file or db  config*/
        if(Request::ajax()){
            return Response::json(array('code' => '403', 'msg' => 'Forbidden Access'));
        } else{
            return Redirect::route('cp-403');
        }
    }
});

/**
 * Check invalid domain from database
 */
Route::filter('domain', function()
{
    $domain = Noweb\Cp\Domain::whereRaw('active = ? AND (alias = ? OR name = ? )', array(1, $_SERVER['SERVER_NAME'],  $_SERVER['SERVER_NAME']))->first();
    if(!$domain)
    {
        return '<pre>Invalid domain</pre>';
    }
});

