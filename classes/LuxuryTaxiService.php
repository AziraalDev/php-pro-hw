<?php

namespace Overload;

class LuxuryTaxiService extends TaxiService
{

    public function createCar(): Car
    {
        return new LuxuryCar();
    }
}