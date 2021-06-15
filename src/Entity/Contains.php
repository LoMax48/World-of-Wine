<?php

namespace App\Entity;

use App\Repository\ContainsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContainsRepository::class)
 */
class Contains
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
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity=Name::class, inversedBy="contains")
     * @ORM\JoinColumn(nullable=false)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="contains", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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

    public function getBooking(): ?Order
    {
        return $this->booking;
    }

    public function setBooking(?Order $booking): self
    {
        $this->booking = $booking;

        return $this;
    }

    public function __toString()
    {
        return $this->name . ": " . $this->number;
    }
}
