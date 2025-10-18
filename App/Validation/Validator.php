<?php

namespace App\Validation;

use App\Validation\Contracts\PropertyConstraint;
use ReflectionAttribute;
use ReflectionClass;

class Validator
{
    /**
     * Inspect attributes on the given entity and run each constraint.
     *
     * @throws \App\Validation\Exception\ValidationException If any constraint is violated.
     */
    public function validate(object $entity): void
    {
        $reflection = new ReflectionClass($entity);

        foreach ($reflection->getProperties() as $property) {
            if (!$property->isInitialized($entity)) {
                $value = null;
            } else {
                $property->setAccessible(true);
                $value = $property->getValue($entity);
            }

            $attributes = $property->getAttributes(PropertyConstraint::class, ReflectionAttribute::IS_INSTANCEOF);

            foreach ($attributes as $attribute) {
                /** @var PropertyConstraint $constraint */
                $constraint = $attribute->newInstance();
                $constraint->validate($property->getName(), $value);
            }
        }
    }
}

