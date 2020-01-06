<?php

define(
    "SITE",
    [
        "name" => "#S-LAB",
        "desc" => "Sistema Laboratorial de Medição e Calibração",
        "domain" => "localhost/",
        "locale" => "pt-br",
        "root" => "https://" . $_SERVER['SERVER_NAME'] . "/SLAB"
    ]
);
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

function url(string $param = null): string
{
    if ($param ) {
        //  return SITE[$param];
        return SITE['root'] . "/{$param}";
    }

    return SITE['root'];
}


/**
 * SOCIAL
 */
define("SOCIAL", [
    "facebook_page" => "",
    "facebook_author" => "",
    "facebook_appId" => "",
    "twitter_creater" => "",
    "twitter_site" => ""
]);

/**
 * MAIL CONNECT
 */
define ("MAIL",[]);