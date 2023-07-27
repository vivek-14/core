<?php

namespace Core\Exceptions;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;
    public static function throw($errors, $old): static
    {
        $instance = new static;
        $instance->errors = $errors;
        $instance->old = $old;
        throw $instance;
    }
}