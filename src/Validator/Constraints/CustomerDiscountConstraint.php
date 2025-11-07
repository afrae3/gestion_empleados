<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute] // <- Esto es lo que faltaba
class CustomerDiscountConstraint extends Constraint
{
    public string $message = 'customer_discount.percentage.too_high';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}
