<?php

namespace Overload\open_closed;

class FormatterWithDate implements IFormatter
{
    public function format($string): string
    {
        return date('Y-m-d') . $string;
    }
}