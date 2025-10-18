<?php

namespace App\Validation\Attributes;

use Attribute;
use App\Validation\Contracts\PropertyConstraint;
use App\Validation\Exception\ValidationException;

#[Attribute(Attribute::TARGET_PROPERTY)]
class NotBlank implements PropertyConstraint
{
    public function validate(string $property, mixed $value): void
    {
        if ($value === null) {
            throw new ValidationException(sprintf(
                'La propriete "%s" ne peut pas etre nulle.',
                $property
            ));
        }

        if (is_string($value) && trim($value) === '') {
            throw new ValidationException(sprintf(
                'La propriete "%s" ne peut pas etre vide.',
                $property
            ));
        }
    }
}
