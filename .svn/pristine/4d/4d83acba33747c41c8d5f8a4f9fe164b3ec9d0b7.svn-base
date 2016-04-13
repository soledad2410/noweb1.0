<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 15/12/2014
 * Time: 3:25 CH
 */

namespace Noweb\Cp;
use \Illuminate\Database\Eloquent\Model,
    \Noweb\Cp\DomainService;

class BaseModel extends Model {

    protected $domain;
    
    public function __construct()
    {
        $domainService = new DomainService();
        $this->domain = $domainService->getDomain();
    }
    
    public function bindData($array)
    {
        $columns = $this->getAttributes();
        if(empty($columns))
        {
            $columns = $this->getAllColumnsNames();
        }
        foreach ($columns as $key=>$value)
        {
            if(isset($array[$key]))
            {
                $this->$key = $array[$key];
            }

        }

    }

    public function getAllColumnsNames()
    {
        switch (\DB::connection()->getConfig('driver')) {
            case 'pgsql':
                $query = "SELECT column_name FROM information_schema.columns WHERE table_name = '".$this->getTable()."'";
                $column_name = 'column_name';
                $reverse = true;
                break;

            case 'mysql':
                $query = 'SHOW COLUMNS FROM '.$this->getTable();
                $column_name = 'Field';
                $reverse = false;
                break;

            case 'sqlsrv':
                $parts = explode('.', $this->getTable());
                $num = (count($parts) - 1);
                $table = $parts[$num];
                $query = "SELECT column_name FROM ".DB::connection()->getConfig('database').".INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'".$table."'";
                $column_name = 'column_name';
                $reverse = false;
                break;

            default:
                $error = 'Database driver not supported: '.DB::connection()->getConfig('driver');
                throw new Exception($error);
                break;
        }

        $columns = array();

        foreach(\DB::select($query) as $column)
        {
            $columns[$column->$column_name] = $column->$column_name; // setting the column name as key too
        }

        if($reverse)
        {
            $columns = array_reverse($columns);
        }

        return $columns;
    }
} 