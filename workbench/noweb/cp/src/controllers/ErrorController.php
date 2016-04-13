<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 11/25/14
 * Time: 5:11 PM
 */

namespace Noweb\Cp;


class ErrorController extends BaseController {

    public function ForbiddenAccess(){
        return '403';
    }

    public function NotFound() {
    return '404';
    }

    public function InvalidRequest() {

    }

} 