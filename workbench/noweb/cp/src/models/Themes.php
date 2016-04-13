<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 26/02/2015
 * Time: 5:28 CH
 */
namespace Noweb\Cp;
use Noweb;
use Noweb\Cp\DomainService;
use Noweb\Cp\Widget;

class Themes extends BaseModel {

	protected $table = 'themes';

	/*  Api process */
	public static function api($action) {

		switch ($action) {
			case 'active':
				$domainService = new DomainService();
				$domainId = $domainService->getDomain()->id;

				// Current themes
				$installedThemes = Themes::where('domain_id', '=', $domainId)->get()->toArray();
				// Module directory
				$moduleDir = $installedThemes[0]['name'] . DIRECTORY_SEPARATOR . 'views';

				// Load all modules
				$moduleService = new ModuleService($moduleDir);
				$allModules = $moduleService->loadModules();
				return $allModules;
				break;

			default:
				# code...
				break;
		}
	}

	public function widget() {
		return $this->hasMany('\Noweb\Cp\Widget', 'theme_id', 'id');
	}

	public function getByName($name) {

		return $this->where('domain_id', '=', $this->domain->id)->where('name', '=', $name)->firstOrFail();
	}

}