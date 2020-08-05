<?php

declare(strict_types=1);

namespace App\Domain;

class Document implements \JsonSerializable
{

    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** @var array */
    private $signers;

    /** @var string */
    private $filePath;

    public function __construct(string $name, string $filePath = "")
    {
        $this->name = $name;
        $this->signers = [];
        $this->filePath = $filePath;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getSigners(): array
    {
        return $this->signers;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function addSigner(Signer $signer): void
    {
        $this->signers[] = $signer;
    }

    public function canSign(): bool
    {
        return count($this->signers) > 0;
    }

    public function jsonSerialize()
    {
        return [
            'sandbox' => $_ENV['AUTENTIQUE_DEV_MODE'] ? 'true' : 'false',
            'document' => [
                'name' => $this->name
            ],
            'signers' => $this->signers,
            'file' => null
        ];
    }
}
