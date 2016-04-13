<?php

namespace Noweb\Cp;

class WidgetService
{
    protected $configPath;
    protected $data;

    public function __construct()
    {
        $this->configPath = public_path('config') . '/widget.xml';
        $this->data = xml2array($this->configPath);
    }

    public function getWidgetType()
    {
        return $this->data;
    }

    public function buildWidgetConfig()
    {
        
    }

}

?>