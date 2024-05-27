<?php

namespace Overload\open_closed;

interface IFormatter
{
    public function format($string) : string;
}