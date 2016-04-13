<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 09/03/2015
 * Time: 3:26 CH
 */

namespace Noweb\Cp;


class InventoryProduct extends  BaseModel {
    protected $table = 'inventory_product';

    protected $remain;

    protected $sold;



    public function getImg()
    {
        $urlService = new \App\Service\URLService($this);
        return $urlService->getThumbnailUrl();
    }

    public function getTotalSold()
    {
        return ;
    }

    public function getTotalRemain()
    {
        $total = \DB::table('inventory_import_product')->where('product_id','=',$this->id)->sum('quantity');
        return $total;
    }


}