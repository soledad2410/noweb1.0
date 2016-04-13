<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 11/21/14
 * Time: 11:03 AM
 */

namespace Noweb\Frontend;

use \Illuminate\Routing\Controller;
use \Noweb\Cp\LayoutService;
use \Noweb\Frontend\Widget;

class BaseController extends Controller {

	protected $theme = 'default';

	protected $template;

	protected $module;

	protected $action;

	protected $resources_path;

	protected $domain_id;

	protected $view;

	protected $extra_data;

	protected $current_language;

	public function __construct() {

		/** @var  $domain Domains */
		$domainService = new \Noweb\Cp\DomainService();
		$this->domain_id = $domainService->getDomain()->id;
		$currentTheme = \Noweb\Cp\Themes::where('domain_id', '=', $this->domain_id)->where('active', '=', 1)->select('name')->first();
		if ($currentTheme) {
			$this->theme = $currentTheme->name;
		}
		/** Get current module and action from router */
		$routerAction = strtolower(\Route::currentRouteAction());
		list($module, $action) = explode('@', $routerAction);

		$tmp = explode('\\', $module);
		$this->module = str_replace('controller', '', end($tmp));
		$this->action = $action;
		$this->view = $this->theme . '.views.' . $this->module . '.' . $this->action;
		if (!$this->view) {
			$this->view = $this->theme . '.views.' . $this->module . '.' . $this->action . '.default';
		}

		/** Language */
		$currentLanguage = \Session::has('current_language') ? \Noweb\Cp\Language::findOrFail(\Session::get('current_language')) : \Noweb\Cp\Language::where('default', '=', 1)->firstOrFail();
		if (!$currentLanguage) {
			$currentLanguage = \Noweb\Cp\Language::where('code', '=', 'vi')->firstOrFail();
		}

		$this->current_language = $currentLanguage;
	}

	/**
	 * (non-PHPdoc)
	 * @see \Illuminate\Routing\Controller::setupLayout()
	 */
	protected function setLayout($template = 'default') {

		$this->layout = $this->theme . '.layouts' . '.' . $template;
		if (!is_null($this->layout)) {
			$this->layout = \View::make($this->layout)->with(['extra_data' => $this->extra_data]);

			\View::share('resources_path', '/public/themes/' . $this->theme . '/resources');
			\View::share('current_module', ['module' => $this->module, 'action' => $this->action]);
			if (\Auth::user()) {
				\View::share('user', \Noweb\Cp\User::find(\Auth::user()->getAuthIdentifier()));
			}
			/** Language */
			\View::share('languages', \Noweb\Cp\Language::all());

			\View::share('current_language', $this->current_language);

			/** Load widgets content */
			$layoutService = new LayoutService();
			$layoutService->setTheme($this->theme);
			$widgets = $layoutService->loadWidgets();

			foreach ($widgets as $key => $value) {

				if (isset($value[0])) {
					$view = strstr($value[0], '.', true);
					\View::share($view, $this->load_widget($key . '.' . $view));
				}
			}
		}
	}

	protected function setView($view = null) {
		if ($view) {
			$this->view = $this->theme . '.views.' . $this->module . '.' . $this->action . '.' . $view;
		} else {
			$this->view = $this->theme . '.views.' . $this->module . '.' . $this->action . '.default';
		}
	}

	protected function get_widget_path($widget = null) {
		if ($widget) {
			return $this->theme . '.widgets.' . $widget;
		}
		return false;

	}

	protected function load_widget($widgets) {

		$widgetObj = new Widget();

		$widget = $widgetObj->get();
		$position = $widget->position;

		switch ($position) {
			case 'nav_main':
				$cateObj = new Category();
				$content = $cateObj->build_menu_html();
				break;

			default:
				$content = null;
				break;
		}

		$widgets = $this->get_widget_path($widgets);
		$view = \View::make($widgets)->with([
			'content' => $content,
		]);
		return $view->render();
	}

}

?>