<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Document;
use App\Domain\Signer;

final class DocumentFactory
{
    public static function fromAutentiqueRequest(object $data)
    {
        $document = new Document($data->name);
        $document->setId($data->id);

        foreach ($data->signatures as $signature) {
            
            if (is_null($signature->action))
                continue;
            
            $signer = new Signer($signature->user->name, $signature->user->email, is_null($signature->signed));
            $document->addSigner($signer);
        }

        return $document;
    }
}
