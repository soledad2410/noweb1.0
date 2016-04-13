<?php

/**
 * Class PublicController
 */

class PublicController extends BaseController {

    protected $template;

    protected $layout;

    protected $module;

    protected $action;

    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = 'cp::layouts.master';
            $this->layout = View::make($this->layout)->with('title','Home page')
                ->with('widget',array(
                    'left_content'=>array(
                        array('title'=>'Widget1'),
                        array('title' => 'Widget2')
                    ),
                    'right_content' => array(
                    array('title' => 'Widget3'),
                    array('title' => 'Widget4')
                     )
                ))
                ->with('meta',array(
                    'title' => 'Home page',
                    'keyword' => 'aaaa',
                    'description' => 'test'
                ));
        }
    }

   public function __construct(){

       parent::__construct();

       /** Get current module and action from router */

       $routerAction = strtolower(Route::currentRouteAction());

       list($module,$action) = explode('@',$routerAction);

       $module =str_replace('controller', '', $module);

       $this->module = $module;

       $this->action = $action;

   }

}
