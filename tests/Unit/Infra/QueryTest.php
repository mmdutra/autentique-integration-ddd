<?php

declare(strict_types=1);

namespace Test\Unit\Infra;

use App\Infrastructure\Endpoints;
use App\Infrastructure\Query;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    /** @test */
    public function will_create_the_graphql_query()
    {
        $method = Endpoints::LIST;

        $query = Query::prepare($method);

        $this->assertIsString($query);
        $this->assertStringNotContainsString("/[\n\r]/", $query);
    }

    /** @test */
    public function will_return_method_not_exists()
    {
        try {
            Query::prepare("test");
            $this->fail("Aceitou um método nao existente!");
        } catch (\Exception $ex) {
            $this->assertEquals("Método não suportado pela API!", $ex->getMessage());
        }
    }
}