<?php

namespace App\Helpers\Traits;

trait CommonTrait
{
    public function getReflectionModel($model)
    {
        // Find which model to use to compute the total price for each case
        $class = 'App\\Helpers\\Interfaces\\' . ucfirst($model);
        /** @var Standards $standards */
        return new $class();
    }
}