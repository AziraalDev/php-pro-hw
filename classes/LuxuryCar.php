<?php

namespace Overload;

class LuxuryCar implements Car
{

    public function getModel(): string
    {
        return 'Luxury VIP car';
    }

    public function getPrice(): float
    {
        return 4.99;
    }
}