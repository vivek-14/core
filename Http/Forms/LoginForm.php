<?php

namespace Http\Forms;

use Core\Exceptions\ValidationException;
use Core\Validator;

class LoginForm
{
    protected array $errors = [];
    public function __construct(public array $attributes)
    {
        if (empty($attributes['email'])) {
            $this->errors['email'] = 'Email s required';
        } elseif (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Email need to be in correct format';
        }
        if (empty($attributes['password'])) {
            $this->errors['password'] = 'Password s required';
        } else if(!Validator::string($attributes['password'], 6, 25)) {
            $this->errors['password'] = "Password length must be between 6 to 25 Characters";
        }
    }

    public static function validate($attributes): null|static
    {
        $instance = new static($attributes);

        return  $instance->failed() ? $instance->throw() : $instance;
    }

    /**
     * @return void
     * @throws ValidationException
     */
    public function throw(): void
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }
    public function failed(): int
    {
        return count($this->errors);
    }

    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * @param $field
     * @param $message
     * @return LoginForm
     */
    public function error($field, $message): static
    {
        $this->errors[$field] = $message;
        return $this;
    }

}