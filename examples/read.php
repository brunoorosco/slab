<?php

require __DIR__ . "/../vendor/autoload.php";

require_once '../Source/Models/User.php';
require_once '../Source/Models/Address.php';

// use CoffeeCode\DataLayer\Connect;

// $conn = Connect::getInstance();
// $error = Connect::getError();

// if($error){
// echo $error->getMessage();
// die();
// }

// var_dump(true);
use Source\Models\Empresa;

$user = new Empresa();
$list = $user->find()->fetch(true);

/**@var $userItem User */
foreach ($list as $userItem) {
    var_dump($userItem->data());
    foreach ($userItem->addresses() as $address) {
        var_dump($address->data());
    }
}
