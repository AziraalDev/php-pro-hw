<?php

namespace Overload\open_closed;

interface IDelivery
{
    public function deliver($formattedString) : void;
}