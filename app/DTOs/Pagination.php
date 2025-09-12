<?php
// app/DTOs/Pagination.php

namespace App\DTOs;

class PaginationModel
{
    public array $items;
    public int $currentPage;
    public int $pageSize;
    public int $totalItems;
    public string $searchTerm;

    public function __construct(
        array $items = [],
        int $currentPage = 1,
        int $pageSize = 10,
        int $totalItems = 0,
        string $searchTerm = ''
    ) {
        $this->items = $items;
        $this->currentPage = $currentPage;
        $this->pageSize = $pageSize > 0 ? $pageSize : 10;
        $this->totalItems = $totalItems;
        $this->searchTerm = $searchTerm;
    }

    public function getTotalPages(): int
    {
        return (int) ceil($this->totalItems / $this->pageSize);
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->getTotalPages();
    }
}
