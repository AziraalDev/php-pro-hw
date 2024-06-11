<?php

namespace App\Commands;

use CliAssistant;
interface Command
{
    public function __construct(CliAssistant $cliAssistant, array $args = []);

    public function run();
}