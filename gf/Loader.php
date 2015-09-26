<?php
/**
 * Created by PhpStorm.
 * User: Filip
 * Date: 9/24/2015
 * Time: 8:25 PM
 */

namespace GF;


final class Loader {
    private static $namespace = array();

    private function __construct(){

    }

    public static function registerAutoLoad(){
        spl_autoload_register(array("\GF\Loader",'autoload'));
    }

    public static function autoload($class){
        self::loadClass($class);
    }

    public static function loadClass($class){
        foreach(self::$namespace as $k=>$v){
            if(strpos($class, $k)===0){
//                echo $k.'<br>'.$v.'<br>'.$class.'<br>';
//                $f=str_replace('\\',DIRECTORY_SEPARATOR, $class);
//                $f=substr_replace($f,$v,0,strlen($k)).'.php';
//                $f = realpath($f);
//                if($f && is_readable($f)){
//                    include $f;
//                }
//                echo $f;

                $file = realpath(substr_replace(str_replace('\\',DIRECTORY_SEPARATOR, $class),$v,0,strlen($k)).'.php');
                if($file && is_readable($file)){
                    include $file;
                }else{
                    throw new \Exception('File cannot be include: '. $file);
                }
                break;
            }
        }
    }

    public static function registerNamespace($namespace, $path){
        $namespace = trim($namespace);
        if(strlen($namespace)>0){
            if(!$path){
                throw new \Exception('Invalid path');
            }
            $_path = realpath($path);

            if($_path && is_dir($_path) && is_readable($_path)){
                self::$namespace[$namespace.'\\'] = $_path . DIRECTORY_SEPARATOR;
            } else{
                throw new \Exception('Namespace directory read error: '.$path);
            }
        }else{
            throw new \Exception('Invalid Namespace:' . $namespace);
        }
    }

    public static function registerNamespaces($ar){
        if(is_array($ar)){
            foreach($ar as $k=>$v){
                self::registerNamespace($k, $v);
            }
        }else{
            throw new \Exception('Invalid namespaces');
        }
    }

    public static function getNamespaces(){
        return self::$namespace;
    }

    public static function removeNamespace($namespace){
        unset(self::$namespace[$namespace]);
    }

    public static function clearNamespaces(){
        self::$namespace=array();
    }

} 