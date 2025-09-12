<?php
// app/DTOs/ValidationErrors.php

namespace App\DTOs;

class ValidationErrors
{
    /** @var array<string, string> */
    public array $errors = [];

    public function __construct(array $errors = [])
    {
        $this->errors = $errors;
    }

    public function addError(string $field, string $message): void
    {
        $this->errors[$field] = $message;
    }

    public function getError(string $field): ?string
    {
        return $this->errors[$field] ?? null;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }
}
