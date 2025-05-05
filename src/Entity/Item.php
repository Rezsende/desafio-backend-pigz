<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Lista;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $descricao;

    #[ORM\Column(type: 'boolean')]
    private bool $concluida = false;

    #[ORM\ManyToOne(targetEntity: Lista::class, inversedBy: 'itens')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lista $lista = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;
        return $this;
    }

    public function isConcluida(): bool
    {
        return $this->concluida;
    }

    public function setConcluida(bool $concluida): self
    {
        $this->concluida = $concluida;
        return $this;
    }

    public function getLista(): ?Lista
    {
        return $this->lista;
    }

    public function setLista(?Lista $lista): self
    {
        $this->lista = $lista;
        return $this;
    }
}
