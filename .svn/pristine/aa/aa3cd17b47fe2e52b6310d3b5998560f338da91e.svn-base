<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 11/12/2014
 * Time: 4:48 CH
 */

namespace Noweb\Cp;


class DomainService {
    protected  $domain;
    public function __construct($domain = null)
    {
        if(!$domain)
        {
            $this->domain = $_SERVER['SERVER_NAME'];
        }
        else
        {
            $this->domain = $domain;
        }   
    }

    /** Validate domain here */
    public function validateDomain()
    {

    }

    public function getDomain()
    {
        $domain = \Noweb\Cp\Domain::whereRaw('active = ? AND (alias = ? OR name = ? )', array(1, $this->domain,  $this->domain))->first();
        return $domain;
    }
} 