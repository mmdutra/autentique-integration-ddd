<?php

declare(strict_types=1);

namespace App\Infrastructure;

use GuzzleHttp\Client as Request;
use Psr\Http\Message\StreamInterface;

class Client
{
    private $client;

    public function __construct()
    {
        $this->auth = "Authorization: Bearer {$_ENV['AUTENTIQUE_TOKEN']}";
        $this->client = new Request();
    }

    public function json(string $query): StreamInterface
    {
        $postFields = '{"query":' . $query . '}';
        $headers = [$this->auth, "Content-Type: application/json"];

        return $this->post($postFields, $headers);
    }

    public function form(string $query, string $file)
    {
        $attributes = '{"query":  ' . $query . '}';

        $postfields = [
            'operations' => $attributes,
            'map' => '{"file": ["variables.file"]}',
            'file' => new \CURLFile($file)
        ];

        return $this->post($postfields, [$this->auth]);
    }

    private function post($fields, array $headers): StreamInterface
    {
        $response = $this->client->post($_ENV['AUTENTIQUE_URL'], [
            'curl' => [
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_POSTFIELDS => $fields,
                CURLOPT_HTTPHEADER => $headers
            ]
        ]);

        return $response->getBody();
    }
}