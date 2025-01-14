<?php

namespace App\Application\Command;

use Symfony\Component\Uid\AbstractUid;

class DeleteNoteCommand
{
    public function __construct(
        readonly public AbstractUid $id
    )
    {
        //
    }
}