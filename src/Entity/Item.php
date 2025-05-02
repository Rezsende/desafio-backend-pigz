<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $descricao;

    #[ORM\Column(type: 'float')]
    private float $preco;

    #[ORM\Column(type: 'float')]
    private float $valor;

    #[ORM\Column(type: 'integer')]
    private int $quantidade;

    #[ORM\Column(type: 'float')]
    private float $total;

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

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): self
    {
        $this->preco = $preco;
        return $this;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;
        return $this;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): self
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;
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
