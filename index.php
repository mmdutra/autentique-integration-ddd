<?php

use App\Infrastructure\AutentiqueIntegration;
use App\Application\Service\DocumentService;
use App\Infrastructure\Client;

require __DIR__ . "/bootstrap.php";

$service = new DocumentService(new AutentiqueIntegration(new Client()));

try {
    $document = new \App\Domain\Document("Contracto", __DIR__ . "/storage/contract/teste.pdf");
//    $document->addSigner(new \App\Domain\Signer("Mateus Morais", "mateus.morais.dev@gmail.com"));
    $response = $service->create($document);
    print_r($response);
} catch (\Exception $ex) {
    error_log("error: " . $ex->getMessage());
}