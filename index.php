<?php

require_once __DIR__ . '/scripts/function.php';
require_once __DIR__ . '/classes/ValueObject.php';

if (isset($_GET['info']) && $_GET['info']) {
    phpinfo();
}

$newColor1 = new \classes\ValueObject(100,100,100);
echo "Color #1: R={$newColor1->getRed()}, G={$newColor1->getGreen()}, B={$newColor1->getBlue()}\n";

$newColor2 = new \classes\ValueObject(250, 250, 250);
echo "Color #2: R={$newColor2->getRed()}, G={$newColor2->getGreen()}, B={$newColor2->getBlue()}\n";
if ($newColor2->equals($newColor1)) {
    echo "Color #1 are equal to Color #2 \n";
}else{
    echo "Color #1 are unequal to Color #2 \n";
}

$randomColor = \classes\ValueObject::random();
echo "Random color: R={$randomColor->getRed()}, G={$randomColor->getGreen()}, B={$randomColor->getBlue()}\n";

$mixedColor = $newColor2->mix($newColor1);
echo "New mixed color: R={$mixedColor->getRed()}, G={$mixedColor->getGreen()}, B={$mixedColor->getBlue()}\n";

$mixedColor2 = $newColor2->mix($randomColor);
echo "Color#2 mixed with random color: R={$mixedColor2->getRed()}, G={$mixedColor2->getGreen()}, B={$mixedColor2->getBlue()}\n";