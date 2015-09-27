<?php
/**
 * Created by PhpStorm.
 * User: Filip
 * Date: 9/24/2015
 * Time: 7:29 PM
 */

namespace GF;
include_once 'Loader.php';
class App {
    private static $_instance = null;
    private $_config = null;
    private $router =null;
    private $_dbConnections=array();

    /**
     *
     * @var \GF\FrontController
     */
    private $_frontController = null;


    private function __construct(){
        \GF\Loader::registerNamespace('GF', dirname(__FILE__).DIRECTORY_SEPARATOR);
        \Gf\Loader::registerAutoLoad();
        $this->_config=\GF\Config::getInstance();
        if($this->_config->getConfigFolder()==null){
            $this->setConfigFolder('../config');
        }
    }

    public function setConfigFolder($path){
        $this->_config->setConfigFolder($path);
    }


    public function getConfigFolder() {
        return $this->_configFolder;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function setRouter($router)
    {
        $this->router = $router;
    }



    public function getConfig(){
        return $this->_config;
    }
    public function run(){
        if($this->_config->getConfigFolder()==null){
            $this->setConfigFolder('../config');
        }
        $this->_frontController = \GF\FrontController::getInstance();
        if($this->router instanceof \GF\Routers\IRouter){
            $this->_frontController->setRouter($this->router);
        }
        else if($this->router=='JsonRPCRouter'){
//            TODO:Fix
            $this->_frontController->setRouter(new \GF\Routers\DefaultRouter());
        }
        else if($this->router=='CLIRouter'){
            $this->_frontController->setRouter(new \GF\Routers\DefaultRouter());
        }
        else{
            $this->_frontController->setRouter(new \GF\Routers\DefaultRouter());
        }

        $this->_frontController->dispatch();
    }

    public function getDBConnection($connection='default'){
        if(!$connection){
            throw new \Exception('No connection identifier provider',500);
        }
        if($this->_dbConnections[$connection]){
            return $this->_dbConnections[$connection];
        }

        $_cnf=$this->getConfig()->database;

        if(!$_cnf[$connection]){
            throw new \Exception('No valid connection identificator is provided',500);
        }

        $dbh = new \PDO($_cnf[$connection]['connection_uri'],$_cnf[$connection]['username'], $_cnf[$connection]['password'], $_cnf[$connection]['pdo_options']);

        $this->_dbConnections[$connection] = $dbh;
        return $dbh;
    }

    public static function getInstance(){
        if(self::$_instance==null){
            self::$_instance = new \GF\App();
        }

        return self::$_instance;
    }
} 