<?php
// app/DTOs/ErrorData.php

namespace App\DTOs;

class ErrorData
{
    public string $message;
    public ?string $stack;

    public function __construct(string $message, ?string $stack = null)
    {
        $this->message = $message;
        $this->stack = $stack;
    }
}
