<?php

require_once __DIR__ . "/vendor/autoload.php";

$dsn = 'mysql:host=mysql;dbname=home_work';

try {
    $pdo = new PDO($dsn, 'root', 'invincible');
    echo 'Nice try!';
} catch (PDOException $e) {
    var_dump($e->getMessage());
}
