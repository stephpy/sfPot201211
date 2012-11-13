<?php

namespace SfPot\Event;

use SfPot\Mailer;

class Alert
{
    private $mailer;
    private $recipients;
    private $food  = array();
    private $drink = array();

    public function __construct(Mailer $mailer, array $recipients)
    {
        $this->mailer     = $mailer;
        $this->recipients = $recipients;
    }

    public function setFood(array $food)
    {
        $this->food = $food;
    }

    public function addDrink(Drink $drink)
    {
        $this->drink[$drink->ident] = $drink;
    }

    public function getFood()
    {
        return $this->food;
    }

    public function getDrink()
    {
        return $this->drink;
    }

    public function send()
    {
        // .......
    }
}
