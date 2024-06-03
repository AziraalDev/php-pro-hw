<?php

namespace Overload;

class EconomCar implements Car
{

    public function getModel(): string
    {
        return 'EconomyCar';
    }

    public function getPrice(): float
    {
        return 2.59;
    }
}