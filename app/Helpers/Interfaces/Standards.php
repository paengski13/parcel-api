<?php

namespace App\Helpers\Interfaces;

interface Standards
{
    /**
     * Compute the
     *
     * @return array
     */
    public function calculate();

    /**
     * Compute the
     *
     * @return array
     */
    public function formatParcelQuote($name, $value, $price, $symbol, $model);
}