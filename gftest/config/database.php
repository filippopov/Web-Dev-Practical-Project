<?php
$cnf['default']['connection_uri']='mysql:host=localhost;dbname=test';
$cnf['default']['username']='gatakka';
$cnf['default']['pass']='1234';
$cnf['default']['php_options'][PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
$cnf['default']['php_options'][PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;


$cnf['session']['connection_uri']='mysql:host=localhost;dbname=session';
$cnf['session']['username']='gatakka';
$cnf['session']['pass']='1234';
$cnf['session']['php_options'][PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES 'UTF8'";
$cnf['session']['php_options'][PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
return $cnf;