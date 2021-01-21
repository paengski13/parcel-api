<?php

namespace App\Helpers\Interfaces;

class Value implements Standards
{
    protected $percentage;
    protected $unit;

    /**
     * value constructor.
     * @param $percentage
     * @param $unit
     */
    public function __construct($percentage = 0, $unit = 0)
    {
        $this->percentage = $percentage;
        $this->unit = $unit;
    }

    /**
     * @inheritDoc
     */
    public function calculate()
    {
        return $this->unit * ($this->percentage / 100);
    }

    /**
     * @inheritDoc
     */
    public function formatParcelQuote($name, $value, $price, $symbol, $model)
    {
        return sprintf("%s: $%s ($%s quote by %s)", $name, floatval($value), floatval($price), $model);
    }
}