<?php

namespace App\Application\Command;

use Symfony\Component\Validator\Constraints as Assert;

class CreateNoteCommand
{
    public function __construct(
        #[Assert\NotBlank]
        public string $name,
        #[Assert\NotBlank]
        public string $content,
    )
    {
        //
    }
}