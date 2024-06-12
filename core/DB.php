<?php

namespace Core;

use mysql_xdevapi\Exception;
use PDO;

class DB
{
    static private PDO|null $isntance = null;

    static public function connect(): PDO
    {
        if (is_null(static::$isntance)) {
            $dsn = 'mysql:host=mysql;dbname=home_work';
            $options = [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            static::$isntance = new PDO(
                $dsn,
                'root',
                'invincible',
                $options);
        }
        return static::$isntance;
    }
}