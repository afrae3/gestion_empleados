<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CustomerDiscountConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof CustomerDiscountConstraint) {
            throw new \Symfony\Component\Validator\Exception\UnexpectedTypeException($constraint, CustomerDiscountConstraint::class);
        }

        if ($value === null) return;

        if ((float)$value > 50) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
