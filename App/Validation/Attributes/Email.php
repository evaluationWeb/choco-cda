<?php

namespace App\Validation\Attributes;

use Attribute;
use App\Validation\Contracts\PropertyConstraint;
use App\Validation\Exception\ValidationException;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Email implements PropertyConstraint
{
    public function validate(string $property, mixed $value): void
    {
        if ($value === null) {
            return;
        }

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException(sprintf(
                'La propriete "%s" doit contenir une adresse email valide.',
                $property
            ));
        }
    }
}
