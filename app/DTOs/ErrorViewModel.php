<?php
// app/DTOs/ErrorViewModel.php

namespace App\DTOs;

class ErrorViewModel
{
    public ?string $requestId;
    public bool $showRequestId;

    public function __construct(?string $requestId = null, bool $showRequestId = false)
    {
        $this->requestId = $requestId;
        $this->showRequestId = $showRequestId;
    }
}
