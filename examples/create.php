<?php

require __DIR__ . "/../vendor/autoload.php";

require_once '../Source/Models/User.php';
use Source\Models\User;

$user = new User();
$user->first_name = "Maria";
$user->last_name = "Mendonça";

$user->save();

var_dump($user);