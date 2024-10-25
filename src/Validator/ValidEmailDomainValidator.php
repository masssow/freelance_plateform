<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidEmailDomainValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\ValidEmailDomain */

        if (null === $value || '' === $value) {
            return;
        }

        // Vérifier si l'email contient un @
        if (!strpos($value, '@')) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
            return;
        }

        // Extraire la partie après le @
        $domain = substr($value, strpos($value, '@') + 1);

        // Extensions valides
        $validExtensions = ['com', 'fr', 'net', 'org'];

        // Vérifier si le domaine a une extension valide
        if (!preg_match('/\.(com|fr|net|org)$/', $domain)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
