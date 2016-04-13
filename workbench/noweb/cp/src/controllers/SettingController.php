<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 15/01/2015
 * Time: 10:42 SA
 */

namespace Noweb\Cp;
use \Noweb\Cp\Language;

class SettingController extends BaseController {

    public function index()
    {
        $this->layout->meta = ['title' => 'Cấu hình hoạt động hệ thống'];
        $settings = \Config::get('cp::settings');
        var_dump($settings);
       	$this->layout->content = \View::make($this->default_view);
    }

    public function switchLang()
    {
        $langId = \Input::get('lang_id');
        if(Language::findOrFail($langId,['id']))
        {
            \Session::put('current_language', $langId);
            return ['code' => 'success',\Session::get('current_language')];
        }
        return ['code' => 'error'];
    }
} 