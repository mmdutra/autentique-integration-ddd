<?php

declare(strict_types=1);

namespace App\Infrastructure;

class Query
{
    private const folder = __DIR__ . '/resources/mutators/';

    public static function prepare(string $file)
    {
        $fileName = self::folder . $file;

        if (!file_exists($fileName))
            throw new \Exception("Método não suportado pela API!");

        $query = file_get_contents($fileName);
        return self::format($query);
    }

    /**
     * @param $query
     * @return string|string[]|null
     */
    private static function format($query)
    {
        return preg_replace("/[\n\r]/", '', $query);
    }

}