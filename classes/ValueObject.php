<?php

namespace Overload;

use http\Exception\InvalidArgumentException;

class ValueObject
{
    private int $red;
    private int $green;
    private int $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        $this->setBlue($blue);
        $this->setRed($red);
        $this->setGreen($green);
    }

    public function getRed(): int
    {
        return $this->red;
    }

    public function getGreen(): int
    {
        return $this->green;
    }

    public function getBlue(): int
    {
        return $this->blue;
    }

    public function setBlue(int $blue): void
    {
        $this->validationColor($blue);
        $this->blue = $blue;
    }

    public function setRed(int $red): void
    {
        $this->validationColor($red);
        $this->red = $red;
    }

    public function setGreen(int $green): void
    {
        $this->validationColor($green);
        $this->green = $green;
    }

    private function validationColor($colorCode) : void
    {
        if ($colorCode < 0 || $colorCode > 255) {
            throw new \InvalidArgumentException("Color code is out of range");
        }
    }

    public function equals(ValueObject $object): bool
    {
        return $this->red === $object->getRed() &&
            $this->green === $object->getGreen() &&
            $this->blue === $object->getBlue();
    }

    public static function random(): ValueObject
    {
        return new ValueObject(rand(0, 255), rand(0, 255), rand(0, 255));
    }

    public function mix(ValueObject $object): ValueObject
    {
        return new ValueObject(ceil(($this->red + $object->getRed()) / 2),
            ceil(($this->green + $object->getGreen()) / 2),
            ceil(($this->blue + $object->getBlue()) / 2));

    }

}
