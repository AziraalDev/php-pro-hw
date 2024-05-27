<?php

require_once __DIR__ . "/vendor/autoload.php";

use Overload\open_closed\Logger as Logger;
use Overload\open_closed\SimpleFormatter as SimpleFormatter;
use Overload\open_closed\SmsDelivery as SmsDelivery;

# Open Closed principle realization
$formatter = new SimpleFormatter();
$delivery = new SmsDelivery();
$logger = new Logger($formatter, $delivery);
$logger->log('Emergency error! Please fix me!');