<?php
/**
 *
 */
namespace Noweb\Cp;

class LayoutService {
	protected $theme;

	protected $themeConfig;

	private $layoutStructure;

	public function __construct() {
		$this->themesDir = public_path('themes');

	}

	/**
	 * @return array
	 * @uses load all themes from theme directory
	 */
	public function loadThemes() {
		$dirs = listDir($this->themesDir);
		$themes = [];
		foreach ($dirs as $dir) {
			if (is_file($this->themesDir . '/' . $dir . '/element.xml')) {
				$themes[] = ['name' => $dir, 'thumb' => '/public/themes/' . $dir . '/thumb.png'];
			}
		}
		return $themes;
	}

	/**
	 *
	 * @param string $theme
	 * @return layout structure
	 */
	public function setTheme($theme) {
		$this->theme = $theme;
		$element = $this->themesDir . '/' . $this->theme . '/element.xml';
		$themeConfig = xml2array($element);
		$this->themeConfig = $themeConfig;
	}

	/**
	 * return pages array
	 */
	public function loadPages() {
		if ($this->theme) {
			$themeConfig = $this->themeConfig;
			$pages = $themeConfig['pages'];
			if (isset($pages['page']) && is_array($pages['page'])) {
				if (isset($pages['page']['0']) && is_array($pages['page']['0'])) {
					return $pages['page'];
				}
				return [$pages['page']];

			}
		}
	}

	/**
	 * return layout array
	 */
	public function loadLayouts() {
		if ($this->theme) {
			$themeConfig = $this->themeConfig;
			$layouts = $themeConfig['layouts'];
			if (isset($layouts['layout']) && is_array($layouts['layout'])) {
				if (isset($layouts['layout']['0']) && is_array($layouts['layout']['0'])) {
					return $layouts['layout'];
				}
				return [$layouts['layout']];
			}
		}
	}

	/**
	 * @param string $layout
	 * @return layout details
	 */
	public function getLayoutByName($layoutName) {
		$layouts = $this->loadLayouts();
		foreach ($layouts as $item) {
			if ($item['name'] == $layoutName) {
				return $item;
			}
		}
		return;
	}

	/**
	 * @param string $layout
	 */
	public function loadPositionByLayout($layoutName) {
		$item = $this->getLayoutByName($layoutName);
		$pos = $item['positions']['position'];
		if (isset($pos['0']) && is_array($pos['0'])) {
			return $pos;
		}
		return false;

	}

	public function loadAllPositions()
	{
	    $pos = [];
        $layouts = $this->loadLayouts();
        foreach($layouts as $layout)
        {
          $pos = array_merge($pos,$this->loadPositionByLayout($layout['name']));
        }

        return $pos;
	}
	/**
	 * @param unknown $position
	 * @return widgets array
	 */
	public function loadWidgets() {
		if ($this->theme) {
			$widgetDir = $this->themesDir . '/' . $this->theme . '/widgets/';
			$dirs = listDir($widgetDir);
			$rs = [];
			foreach ($dirs as $dir) {
				$rs[$dir] = listFile($widgetDir . $dir . '/', ['.php']);
			}

			return $rs;
		}
	}

	public function getThemeInfo()
	{
        return $this->themeConfig['info'];
	}
}

?>