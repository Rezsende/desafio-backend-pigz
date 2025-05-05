<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private string $senha;

    #[ORM\Column(length: 50)]
    private string $nivelAcesso;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dataCriacao;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dataAtualizacao;

   
    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Lista::class)]
    private $listas;

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->dataCriacao = new \DateTimeImmutable();
        $this->dataAtualizacao = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->dataAtualizacao = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): static
    {
        $this->senha = $senha;
        return $this;
    }

    public function getNivelAcesso(): string
    {
        return $this->nivelAcesso;
    }

    public function setNivelAcesso(string $nivelAcesso): static
    {
        $this->nivelAcesso = $nivelAcesso;
        return $this;
    }

    public function getDataCriacao(): \DateTimeInterface
    {
        return $this->dataCriacao;
    }

    public function getDataAtualizacao(): \DateTimeInterface
    {
        return $this->dataAtualizacao;
    }
    public function getListas()
    {
        return $this->listas;
    }

    public function addLista(Lista $lista): self
    {
        $this->listas[] = $lista;
        return $this;
    }
}
