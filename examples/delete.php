<?php

require __DIR__ . "/../vendor/autoload.php";

require_once '../Source/Models/User.php';

use Source\Models\User;

$user = (new User())->findById(3);

if ($user) {
    $user->destroy();
} else {
    var_dump($user);
}
