<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
class ValidEmailDomain extends Constraint
{
    public $message = "L'adresse email doit contenir un '@' et une extension valide comme .com, .fr, .net.";

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }
}
