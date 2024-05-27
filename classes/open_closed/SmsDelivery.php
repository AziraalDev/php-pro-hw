<?php

namespace Overload\open_closed;

class SmsDelivery implements IDelivery
{
    public function deliver($formattedString): void
    {
        echo "Output formatted string by sms: " . $formattedString;
    }
}