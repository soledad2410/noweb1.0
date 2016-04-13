<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 08/01/2015
 * Time: 11:51 SA
 * Store cache by domain and user id
 */

namespace Noweb\Cp;


class CachingService {

    public function getCachePrefix()
    {
        $domainService = new \Noweb\Cp\DomainService();
        $domainId = $domainService->getDomain()->id;
        $userId = \Auth::user()->getAuthIdentifier();
        return 'noweb_' . $domainId . '_' . $userId . '_';
    }
    public function push($key,$value, $minutes = null)
    {
        $key = $this->getCachePrefix() . $key;
        if(!$minutes)
        {
            return \Cache::forever($key,$value);
        }
        return \Cache::put($key , $value, $minutes);
    }

    public function get($key,$defaultValue = null)
    {
        $key = $this->getCachePrefix() . $key;
        if(\Cache::has($key))
        {
            if($defaultValue)
            {
                return \Cache::get($key, $defaultValue);
            }
            return \Cache::get($key);
        }
        return null;
    }

    public function delete($key)
    {
        $key = $this->getCachePrefix() . $key;
        return \Cache::forget($key);
    }
    /**
     * Get cache then delete this
     * */
    public function pull($key)
    {
        $key = $this->getCachePrefix() . $key;
        if(\Cache::has($key))
        {
            return \Cache::pull($key);
        }
    }
} 