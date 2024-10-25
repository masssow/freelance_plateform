<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidPasswordValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\ValidPassword */

        if (null === $value || '' === $value) {
            return;
        }

        // Vérification pour au moins une majuscule et un chiffre
        if (!preg_match('/[A-Z]/', $value) || !preg_match('/[0-9]/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
