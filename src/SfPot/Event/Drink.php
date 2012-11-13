<?php

namespace SfPot\Event;

class Drink
{
    public $ident;
    public $type;
    public $quantity;

    public static function create($ident, $type, $quantity = 0)
    {
        $instance = new static();
        $instance->ident = $ident;
        $instance->type = $type;
        $instance->quantity = $quantity;

        return $instance;
    }
}
