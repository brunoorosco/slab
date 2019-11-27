<?php

require __DIR__ . "/../vendor/autoload.php";

require_once '../Source/Models/User.php';
use Source\Models\User;

$user = (new User())->findById(4);
$user->last_name = "Paulo";

$user->save();

var_dump($user);