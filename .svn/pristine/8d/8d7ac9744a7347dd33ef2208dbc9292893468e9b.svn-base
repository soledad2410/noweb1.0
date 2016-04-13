<?php
/**
 *
 */
namespace Noweb\Cp;

class ModuleService {

	public function __construct($moduleDir) {
		$this->moduleDir = public_path('themes' . DIRECTORY_SEPARATOR . $moduleDir);
	}

	/**
	 * @return array
	 * @uses load all themes from theme directory
	 */
	public function loadModules() {
		$dirs = listDir($this->moduleDir);
		$modules = [];
		foreach ($dirs as $dir) {
			if ($dir != 'index') {
				$modules[] = $dir;
			}
		}
		return $modules;
	}
}

?>