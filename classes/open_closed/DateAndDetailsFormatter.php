<?php

namespace Overload\open_closed;

class DateAndDetailsFormatter implements IFormatter
{
    public function format($string) : string
    {
        return date('Y-m-d') . $string . 'some details here';
    }
}