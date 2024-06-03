<?php

namespace Overload;

class StandardTaxiService extends TaxiService
{

    public function createCar(): Car
    {
        return new StandartCar();
    }
}