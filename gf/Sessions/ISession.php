<?php
/**
 * Created by PhpStorm.
 * User: Filip
 * Date: 9/28/2015
 * Time: 12:30 AM
 */
namespace GF\Session;
interface ISession {
    public function getSessionId();
    public function saveSession();
    public function destroySession();
    public function __get($name);
    public function __set($name, $value);
} 