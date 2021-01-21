<?php

namespace App\Helpers\Interfaces;

class Weight implements Standards
{
    protected $valuePerUnit;
    protected $unit;

    /**
     * Weight constructor.
     * @param $valuePerUnit
     * @param $unit
     */
    public function __construct($valuePerUnit = 0, $unit = 0)
    {
        $this->valuePerUnit = $valuePerUnit;
        $this->unit = $unit;
    }

    /**
     * @inheritDoc
     */
    public function calculate()
    {
        return ($this->unit * $this->valuePerUnit) / 1;
    }

    /**
     * @inheritDoc
     */
    public function formatParcelQuote($name, $value, $price, $symbol, $model)
    {
        return sprintf("%s: %s%s ($%s quote by %s)", $name, $symbol, floatval($value), floatValue($price), $model);
    }
}