<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use Throwable;

class DocumentNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Documento não encontrado!", 404);
    }
}