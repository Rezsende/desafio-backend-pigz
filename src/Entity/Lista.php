<?php

namespace App\Entity;

use App\Repository\ListaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListaRepository::class)]
class Lista
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nome;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'listas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    #[ORM\OneToMany(mappedBy: 'lista', targetEntity: Item::class, orphanRemoval: true)]
    private $itens;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getItens()
    {
        return $this->itens;
    }

    public function addItem(Item $item): self
    {
        $this->itens[] = $item;
        return $this;
    }
}
