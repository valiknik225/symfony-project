<?php

namespace App\Domain\Exception;

use Exception;
use Symfony\Component\Uid\Uuid;

class NoteNotFoundException extends Exception
{
    public function __construct(
        string               $message = "Note not found",
        private readonly int $statusCode = 404,
        private ?Uuid        $noteId = null
    )
    {
        $fullMessage = $noteId ? "$message: $noteId" : $message;

        parent::__construct($fullMessage, $statusCode);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getNoteId(): ?Uuid
    {
        return $this->noteId;
    }

    public function __toString(): string
    {
        return sprintf(
            "NoteNotFoundException: [%d]: %s. Note ID: %s",
            $this->statusCode,
            $this->message,
            $this->noteId ?? 'N/A'
        );
    }
}