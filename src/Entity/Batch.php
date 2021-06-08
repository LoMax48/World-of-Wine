<?php

namespace App\Entity;

use App\Repository\BatchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BatchRepository::class)
 */
class Batch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $size;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Fridge::class, inversedBy="batches")
     */
    private $fridge;

    /**
     * @ORM\ManyToOne(targetEntity=Name::class, inversedBy="batches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFridge(): ?Fridge
    {
        return $this->fridge;
    }

    public function setFridge(?Fridge $fridge): self
    {
        $this->fridge = $fridge;

        return $this;
    }

    public function getName(): ?Name
    {
        return $this->name;
    }

    public function setName(?Name $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->id;
    }
}
