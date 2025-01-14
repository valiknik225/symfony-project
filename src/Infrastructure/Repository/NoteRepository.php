<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Note;
use App\Domain\Exception\NoteNotFoundException;
use App\Domain\Storage\NoteRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Uid\Uuid;

class NoteRepository implements NoteRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
        //
    }

    public function save(Note $note): void
    {
        $this->entityManager->persist($note);
        $this->entityManager->flush();
    }

    public function delete(Note $note): void
    {
        $this->entityManager->remove($note);
        $this->entityManager->flush();
    }

    /**
     * @throws NoteNotFoundException
     */
    public function findById(AbstractUid $id): Note
    {
        $object = $this->entityManager->getRepository(Note::class)->find($id);
        if (is_null($object)) {
            throw new NoteNotFoundException();
        }
        return $object;
    }

    public function getNextIdentity(): AbstractUid
    {
        return Uuid::v6();
    }
}