<?php

namespace App\Validation\Contracts;

interface PropertyConstraint
{
    /**
     * Validate the given value for the provided property name.
     *
     * @throws \App\Validation\Exception\ValidationException When the value violates the constraint.
     */
    public function validate(string $property, mixed $value): void;
}

