<?php

namespace Overload\open_closed;

class SimpleFormatter implements IFormatter
{
    public function format($string) : string
    {
        return $string;
    }
}