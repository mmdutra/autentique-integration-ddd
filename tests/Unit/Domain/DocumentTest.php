<?php

declare(strict_types=1);

namespace Test\Unit\Domain;

use App\Domain\Document;
use App\Domain\Signer;
use PHPUnit\Framework\TestCase;
use Test\Builder\DocumentBuilder;

class DocumentTest extends TestCase
{
    /** @test */
    public function will_add_signer()
    {
        $document = new Document("Contrato");
        $document->addSigner(new Signer("teste teste", "teste@test.com"));

        $this->assertCount(1, $document->getSigners());
    }

    /** @test */
    public function will_check_serialization_of_document()
    {
        $document = DocumentBuilder::createWithSigner();

        $response = json_encode($document);

        $this->assertIsString($response);
    }

    /** @test */
    public function will_return_document_in_json()
    {
        $document = DocumentBuilder::createWithSigner();
        $response = $document->jsonSerialize();

        $this->assertArrayHasKey("sandbox", $response);
        $this->assertArrayHasKey("document", $response);
        $this->assertArrayHasKey("signers", $response);
        $this->assertArrayHasKey("file", $response);
    }

    /** @test */
    public function will_return_that_document_can_be_signed()
    {
        $document = DocumentBuilder::createWithSigner();

        $this->assertTrue($document->canSign());
    }

    /** @test */
    public function will_return_that_document_cant_be_signed()
    {
        $document = new Document("teste");

        $this->assertFalse($document->canSign());
    }
}