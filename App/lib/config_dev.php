<?php
/**
 * Created by PhpStorm.
 * User: TiagoGouvea
 * Date: 31/10/15
 * Time: 16:03
 */
// error_reporting(E_ALL ^ E_NOTICE);
// ini_set('error_reporting', 1);

// $host='10.104.68.9';
// $dbname='slab';
// $user='slab';
// $password='sen@i1045bd';

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "db_igreja",
    "username" => "brunoorosco",
    "passwd" => "123456",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
