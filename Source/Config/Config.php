<?php

define("ROOT", "https://".$_SERVER['SERVER_NAME']."/www/SLAB");


define("SITE", "#S-LAB");
//echo $_SERVER['SERVER_NAME'];

if ($_SERVER['SERVER_NAME'] != 'www.localhost') {
    define("DATA_LAYER_CONFIG", [
        "driver" => "mysql",
        "host" => "localhost",
        "port" => "3306",
        "dbname" => "slab",
        "username" => "brunoorosco",
        "passwd" => "123456",
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ]);
} else {
    define("DATA_LAYER_CONFIG", [
        "driver" => "mysql",
        "host" => $_SERVER['SERVER_NAME'],
        "port" => "3306",
        "dbname" => "slab",
        "username" => "brunoorosco",
        "passwd" => "123456",
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ]);
}
/**
 * @param string|null $uri
 * @return string
 */
function url(string $uri = null): string
{
    if ($uri) {
        return ROOT . "/{$uri}";
    }

    return ROOT;
}
