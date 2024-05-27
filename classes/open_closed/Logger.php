<?php

namespace Overload\open_closed;

class Logger
{
 private $formatter;
 private $delivery;
 public function __construct(IFormatter $formatter, IDelivery $delivery) {
     $this->formatter = $formatter;
     $this->delivery = $delivery;
 }
 public function log($string){
     $formattedString = $this->formatter->format($string);
     $this->delivery->deliver($formattedString);
 }

}