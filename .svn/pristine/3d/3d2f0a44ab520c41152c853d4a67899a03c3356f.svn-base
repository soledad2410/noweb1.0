<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 09/03/2015
 * Time: 3:34 CH
 */

namespace Noweb\Cp;


class Brand  extends BaseModel{

    protected $table = 'brand';

    public function getLogo()
    {
        $urlService = new \App\Service\URLService($this);
        return $urlService->getThumbnailUrl();
    }
}