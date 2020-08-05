<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Contracts\DocumentRepository;
use App\Domain\Document;
use App\Domain\Exceptions\DocumentCantBeSignedException;
use App\Domain\Exceptions\DocumentNotFoundException;
use App\Domain\Factory\DocumentFactory;

class DocumentService
{
    private $documentRepository;

    public function __construct(DocumentRepository $documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    public function create(Document $document): Document
    {
        if (!$document->canSign())
            throw new DocumentCantBeSignedException();

        $result = $this->documentRepository->create($document);

        return DocumentFactory::fromAutentiqueRequest($result);
    }

    public function list(): array
    {
        $documents = $this->documentRepository->list(1);

        $result = [];

        foreach ($documents as $item)
            $result[] = DocumentFactory::fromAutentiqueRequest($item);

        return $result;
    }

    public function find (string $documentId): ?Document
    {
        $document = $this->documentRepository->find($documentId);

        if(is_null($document))
            throw new DocumentNotFoundException();

        return DocumentFactory::fromAutentiqueRequest($document);
    }
}