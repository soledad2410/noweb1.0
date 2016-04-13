<?php
namespace Noweb\Cp;

Class Widget extends BaseModel {

	protected $table = 'widget';

	/**
	 *
	 * @param string $theme
	 * @param string $layout
	 * @param string $position
	 */
	public function loadWidgetsByTheme($theme, $layout = false, $position = false) {
		$widgets = $this->where('theme_id', '=', $theme);
		if ($layout) {
			$widgets = $widgets->where('layout', '=', $layout);
		}
		if ($position) {
			$widgets = $widgets->where('position', '=', $position);
		}
		$widgets = $widgets->orderby('queu', 'asc')->get();
		return $widgets;
	}

	/**
	 *
	 */
	public function loadWidgetContent() {

	}
}