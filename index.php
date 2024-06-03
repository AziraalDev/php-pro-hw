<?php

use Overload\EconomTaxiService;
use Overload\LuxuryTaxiService;
use Overload\StandardTaxiService;
use Overload\TaxiService;

require_once __DIR__ . "/vendor/autoload.php";

function initiateTaxiService(TaxiService $taxiService): void
{
    $taxiService->getCarDetails();
}
echo '<pre style="font-size: 20px">';
echo "\nEconom taxi service\n";
initiateTaxiService(new EconomTaxiService());

echo "\nStandard taxi service\n";
initiateTaxiService(new StandardTaxiService());

echo "\nLuxury taxi service\n";
initiateTaxiService(new LuxuryTaxiService());
echo '</pre>';