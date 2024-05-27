<?php

namespace Overload\open_closed;

class ConsoleDelivery implements IDelivery
{
    public function deliver($formattedString): void
    {
        echo "Output formatted string by console: " . $formattedString;
    }
}