<?php

namespace Overload;

abstract class TaxiService
{
    abstract public function createCar() : Car;
    public function getCarDetails() : void
    {
        $car = $this->createCar();
        echo "Car Model: " . $car->getModel() . "\n";
        echo "Car Price: " . $car->getPrice() . "\n";
}
}