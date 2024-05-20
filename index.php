<?php

require_once __DIR__ . "/vendor/autoload.php";

use Overload\User as OverloadedUser;
use Overload\MyException as MyException;

$newUser = new OverloadedUser('Ivan', 44, 'Ivan.ukraine@gmail.com');
try {
    $newUser->setAge(45);
    $newUser->setName('Thor');
    echo "<pre>";
    print_r($newUser->getAll());
    echo "</pre>";
    $newUser->setKids();
} catch (MyException $e) {
    echo $e->getMessage();
}