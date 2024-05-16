<?php

require_once __DIR__ . '/scripts/function.php';

if (isset($_GET['info']) && $_GET['info']) {
    phpinfo();
}