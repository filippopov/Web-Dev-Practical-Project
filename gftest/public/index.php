<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'On');


include '../../gf/App.php';

$app = \GF\App::getInstance();

//$config = \GF\Config::getInstance();
//echo $app->getConfig()->app;

$db = new \GF\DB\SimpleDB();

//$a = $db->prepare('SELECT * FROM users WHERE id=?')->execute(array(1))->fetchAllAssoc();
var_dump($a);
$app->run();


//\GF\Loader::registerNamespace('Test\Models','C:\xampp\htdocs\Web-Dev-Practical-Project\gftest\models'); -1