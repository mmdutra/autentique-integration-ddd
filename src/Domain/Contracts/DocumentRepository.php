<?php

namespace App\Domain\Contracts;

use App\Domain\Document;

interface DocumentRepository
{
    public function create(Document $document);
    public function list(int $page): array;
    public function find(string $documentId): ?object;
}