<?php

namespace App\Validator;

Use Symfony\component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
Class ValidPassword extends Constraint
{
    public $message = 'Le mot de passe doit contenir au moins une lettre majuscule et un chiffre.';
    
    Public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}