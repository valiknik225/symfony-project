<?php

namespace App\Domain\Storage;

use App\Domain\Entity\Note;
use App\Domain\Exception\NoteNotFoundException;
use Symfony\Component\Uid\AbstractUid;

interface NoteRepositoryInterface
{
    public function getNextIdentity(): AbstractUid;
    public function save(Note $note): void;
    public function delete(Note $note): void;

    /**
     * @param AbstractUid $id
     * @return Note
     * @throws NoteNotFoundException
     */
    public function findById(AbstractUid $id): Note;
}