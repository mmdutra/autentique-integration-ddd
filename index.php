<?php

use App\Infrastructure\AutentiqueIntegration;
use App\Application\Service\DocumentService;
use App\Infrastructure\Client;

require __DIR__ . "/bootstrap.php";

$service = new DocumentService(new AutentiqueIntegration(new Client()));

try {
    $document = new \App\Domain\Document("Contrato", __DIR__ . "/storage/contract/teste.pdf");
    $response = $service->create($document);
    print_r($response);
} catch (\Exception $ex) {
    error_log("error: " . $ex->getMessage());
}
