<?php

namespace Overload;

class StandartCar implements Car
{

    public function getModel(): string
    {
        return 'Standard car';
    }

    public function getPrice(): float
    {
        return 2.99;
    }
}