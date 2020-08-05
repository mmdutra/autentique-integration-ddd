<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Domain\Contracts\DocumentRepository;
use App\Domain\Document;
use App\Domain\Exceptions\DocumentNotFoundException;

class AutentiqueIntegration implements DocumentRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(Document $document)
    {
        $query = Query::prepare(Endpoints::CREATE);
        $query = str_replace('$variables', json_encode($document), $query);
        $result = $this->client->form($query, $document->getFilePath());

        $content = json_decode($result->getContents());
        
        if (isset($content->errors))
            throw new \Exception("Documento inválido! - " . json_encode($content->errors), 400);

        return $content->data->createDocument;
    }

    public function list(int $page = 1): array
    {
        $query = Query::prepare(Endpoints::LIST);
        $query = str_replace('$page', $page, $query);

        $response = $this->client->json($query);

        if (!$response) {
            return [];
        }

        $content = json_decode($response->getContents());

        return $content->data->documents->data;
    }

    public function find(string $documentId): object
    {
        $query = Query::prepare(Endpoints::FIND);
        $query = str_replace('$documentId', $documentId, $query);

        $response = $this->client->json($query);

        if (!$response)
            throw new DocumentNotFoundException();

        $content = json_decode($response->getContents());

        return $content->data->document;
    }
}
