<?php

namespace App\Application\CommandHandler;

use App\Application\Command\CreateNoteCommand;
use App\Domain\Entity\Note;
use App\Domain\Storage\NoteRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateNoteHandler
{
    public function __construct(
        private readonly NoteRepositoryInterface $noteRepository
    )
    {
        //
    }

    public function __invoke(CreateNoteCommand $command): void
    {
        $note = new Note($this->noteRepository->getNextIdentity(), $command->name, $command->content);
        $this->noteRepository->save($note);
    }
}