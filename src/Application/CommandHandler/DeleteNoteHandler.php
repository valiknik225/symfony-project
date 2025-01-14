<?php

namespace App\Application\CommandHandler;

use App\Application\Command\CreateNoteCommand;
use App\Application\Command\DeleteNoteCommand;
use App\Domain\Entity\Note;
use App\Domain\Exception\NoteNotFoundException;
use App\Domain\Storage\NoteRepositoryInterface;

class DeleteNoteHandler
{
    public function __construct(
        private readonly NoteRepositoryInterface $noteRepository
    )
    {
        //
    }

    /**
     * @throws NoteNotFoundException
     */
    public function __invoke(DeleteNoteCommand $command): void
    {
        $note = $this->noteRepository->findById($command->id);
        $this->noteRepository->delete($note);
    }
}