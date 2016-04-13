<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 09/03/2015
 * Time: 3:34 CH
 */

namespace Noweb\Cp;

class WidgetType extends BaseModel {

	protected $table = 'widget_type';
	public $timestamps = false;
    protected $config =[
        ['title'=>'','name'=>'','type'=>'','value']
    ];

	public function serializeWidgetConfig()
	{
        $configTitles = explode('|', $this->config_title);
        $configNames = explode('|', $this->config_name);
        $fieldsType = explode('|', $this->field_type);
        $fieldsValue = explode('|', $this->field_value);
        $config = [];
        if(count($configTitles) == count($configNames) && count($configTitles) == count($fieldsType) && count($configTitles) == count($fieldsValue) && count($configTitles) > 0)
        {
            for($i = 0; $i < count($configTitles) ; $i ++)
            {
                $vals = $fieldsValue[$i];
                if($fieldsType[$i] == 'checkbox' || $fieldsType[$i] == 'radio' || $fieldsType[$i] == 'selectbox')
                {
                    $tmps = explode(',', $fieldsValue[$i]);
                    foreach ($tmps as $item){

                    }
                }
                $this->config[] = ['title'=>$configTitles[$i],'name'=>$configNames[$i],'type'=>$fieldsType[$i],'value'=>''];
            }

        }
	}

	public function getConfig()
	{
	    $this->serializeWidgetConfig();
	    return $this->config;
	}
}