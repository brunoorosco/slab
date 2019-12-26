<?php

header('Content-Type: text/html; charset=utf-8');

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
use Source\Models\Address;

$user = new Empresa();
$list = $user->find()->fetch(true);
// $list = $user->findById(1);
//var_dump($list->Status);

/**@var $userItem User */
foreach ($list as $userItem) {
    $cnpj = preg_replace("/[^0-9]/", "", $userItem->CNPJ);
   // var_dump($userItem->CNPJ);
    $empresa = $user->find("CNPJ = :name", "name={$userItem->CNPJ}")->fetch();
    $userItem->CNPJ = $cnpj;
    $userItem->save();
    echo "<br>";
    
    //   foreach ($userItem->addresses() as $address) {
    //       var_dump($address->data());
    //   }
}

//$empresa = (new User())->find("CNPJ = :name", "name={$userItem->CNPJ}")->fetch(false);

//$user->CNPJ = "Paulo";
//$user->save();