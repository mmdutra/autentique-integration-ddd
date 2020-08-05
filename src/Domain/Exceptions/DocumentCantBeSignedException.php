<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;

use \Throwable;

class DocumentCantBeSignedException extends \Exception
{
    public function __construct()
    {
        parent::__construct("O documento não pode ser assinado!", 403);
    }
}