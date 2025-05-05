<?php

namespace App\Entity;

use App\Repository\ListaRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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

    #[ORM\OneToMany(mappedBy: 'lista', targetEntity: Item::class, cascade: ['remove'], orphanRemoval: true)]
    private Collection $itens;

    public function __construct()
    {
        $this->itens = new ArrayCollection();  
    }

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

    public function getItens(): Collection
    {
        return $this->itens;
    }

    public function setItens(Collection $itens): self
    {
        $this->itens = $itens;
        return $this;
    }
}
