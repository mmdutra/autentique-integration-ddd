<?php

declare(strict_types=1);

namespace Test\Unit\Domain;

use App\Domain\Signer;
use PHPUnit\Framework\TestCase;

class SignerTest extends TestCase
{
    /** @test */
    public function will_create_a_signer()
    {
        $signer = new Signer("teste teste", "teste@test.com");

        $this->assertInstanceOf(Signer::class, $signer);
    }

    /** @test */
    public function will_return_name_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Signer("123123 ", "123");
    }

    /** @test */
    public function will_return_email_is_invalid()
    {
        $this->expectException(\InvalidArgumentException::class);

        new Signer("teste teste", "123");
    }
}