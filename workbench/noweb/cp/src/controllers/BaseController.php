<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 11/21/14
 * Time: 11:03 AM
 */

namespace Noweb\Cp;

use Illuminate\Http\Response;
use \Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;

class BaseController extends Controller  {

    protected $template;

    protected $layout = 'cp::layouts.default';

    protected $module;

    protected $action;

    protected $resources_path;

    protected $domain_id;

    protected $default_view;

    protected $current_language;

    public function __construct(){

        /** Get current module and action from router */
        $routerAction = strtolower(\Route::currentRouteAction());
        list($module,$action) = explode('@',$routerAction);
        $this->resources_path = '/public/packages/noweb/cp/asset/resources';
        $tmp = explode('\\', $module);
        $this->module = str_replace('controller','',end($tmp));
        $this->action = $action;
        $this->default_view = 'cp::' . $this->module . '.' . $this->action;
        /** @var  $domain Domains */
        $domainService = new DomainService();
        $this->domain_id = $domainService->getDomain()->id;
        /** Language */
        $currentLanguage = \Session::has('current_language') ? \Noweb\Cp\Language::findOrFail(\Session::get('current_language')) : \Noweb\Cp\Language::where('default', '=', 1)->firstOrFail();
        if(!$currentLanguage)
        {
            $currentLanguage =  \Noweb\Cp\Language::where('code', '=', 'vi')->firstOrFail();
        }
        $this->current_language = $currentLanguage;
    }

    public function setupLayout() {
        if ( ! is_null($this->layout))
        {
            $this->layout = \View::make($this->layout)->with('title','Home page')
                ->with('meta',array(
                    'title' => 'Homepage',
                    'keyword' => 'aaaa',
                    'description' => 'test'
                ));

            \View::share('resources_path',$this->resources_path);
            \View::share('current_module', ['module' => $this->module, 'action' => $this->action]);
            if(\Auth::user())
            {
                \View::share('user', User::find(\Auth::user()->getAuthIdentifier()));
            }
            /** Language */
            \View::share('languages',\Noweb\Cp\Language::all());

            \View::share('current_language', $this->current_language);
        }
    }


}