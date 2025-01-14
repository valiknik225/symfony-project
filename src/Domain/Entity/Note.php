<?php

namespace App\Domain\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\AbstractUid;

#[ORM\Entity]
#[ORM\Table(name: 'notes')]
class Note
{
    #[ORM\Column(type: Types::DATE_IMMUTABLE,)]
    private DateTimeInterface $createdAt;

    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: 'uuid', unique: true)]
        #[ORM\GeneratedValue(strategy: 'NONE')]
        private readonly AbstractUid $id,
        #[ORM\Column(type: 'text')]
        private string               $name,
        #[ORM\Column(type: 'text')]
        private string               $content,
    )
    {
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): AbstractUid
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function updateName(string $name): void
    {
        $this->name = $name;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function updateContent(string $content): void
    {
        $this->content = $content;
    }
}