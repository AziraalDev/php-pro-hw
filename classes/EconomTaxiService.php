<?php

namespace Overload;

class EconomTaxiService extends TaxiService
{

    public function createCar(): Car
    {
        return new EconomCar();
    }
}