<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute] // <- Esto es lo que faltaba
class CustomerDiscountConstraint extends Constraint
{
    public string $message = 'El descuento no puede ser mayor al 50%.';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
