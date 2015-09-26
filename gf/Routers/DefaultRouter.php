<?php
/**
 * Created by PhpStorm.
 * User: Filip
 * Date: 9/25/2015
 * Time: 10:53 PM
 */
namespace GF\Routers;
class DefaultRouter implements \GF\Routers\IRouter{
    public function getURI(){
        return substr($_SERVER["PHP_SELF"], strlen($_SERVER['SCRIPT_NAME'])+1);
    }
} 