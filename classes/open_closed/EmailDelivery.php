<?php

namespace Overload\open_closed;

class EmailDelivery implements IDelivery
{
    public function deliver($formattedString): void
    {
        echo "Output formatted string by e-mail: " . $formattedString;
    }
}