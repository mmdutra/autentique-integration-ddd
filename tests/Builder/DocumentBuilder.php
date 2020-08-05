<?php

declare(strict_types=1);

namespace Test\Builder;

use App\Domain\Document;
use App\Domain\Signer;

class DocumentBuilder
{
    public static function createWithSigner(): Document
    {
        $document = new Document("Contrato");
        $document->addSigner(new Signer("teste teste", "teste@test.com"));

        return $document;
    }
}