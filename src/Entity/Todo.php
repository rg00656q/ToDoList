<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TodoRepository;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
class Todo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $body = null;

    #[Assert\GreaterThan(0)]
    #[Assert\LessThan(4)]
    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\Column]
    private ?bool $iscompleted = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function isIscompleted(): ?bool
    {
        return $this->iscompleted;
    }

    public function setIscompleted(bool $iscompleted): self
    {
        $this->iscompleted = $iscompleted;

        return $this;
    }
}
