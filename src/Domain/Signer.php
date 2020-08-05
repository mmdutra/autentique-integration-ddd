<?php

declare(strict_types=1);

namespace App\Domain;

class Signer implements \JsonSerializable
{
    /**@var string */
    private $name;

    /**@var string */
    private $email;

    /** @var string */
    private $action = SignerAction::SIGN;

    /** @var bool */
    private $signed;

    public function __construct(string $name, string $email, bool $signed = false)
    {
        $this->name = $name;
        $this->setEmail($email);
        $this->signed = $signed;
    }

    private function setEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new \InvalidArgumentException("Email inválido!");

        $this->email = $email;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'action' => $this->action
        ];
    }
}