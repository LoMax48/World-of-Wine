<?php

namespace App\Entity;

use App\Repository\NameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NameRepository::class)
 */
class Name
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $sugar;

    /**
     * @ORM\Column(type="integer")
     */
    private $degrees;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sweetness;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=1023)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Batch::class, mappedBy="name")
     */
    private $batches;

    /**
     * @ORM\OneToMany(targetEntity=Contains::class, mappedBy="name")
     */
    private $contains;

    public function __construct()
    {
        $this->batches = new ArrayCollection();
        $this->contains = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getSugar(): ?int
    {
        return $this->sugar;
    }

    public function setSugar(int $sugar): self
    {
        $this->sugar = $sugar;

        return $this;
    }

    public function getDegrees(): ?int
    {
        return $this->degrees;
    }

    public function setDegrees(int $degrees): self
    {
        $this->degrees = $degrees;

        return $this;
    }

    public function getSweetness(): ?string
    {
        return $this->sweetness;
    }

    public function setSweetness(string $sweetness): self
    {
        $this->sweetness = $sweetness;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Batch[]
     */
    public function getBatches(): Collection
    {
        return $this->batches;
    }

    public function addBatch(Batch $batch): self
    {
        if (!$this->batches->contains($batch)) {
            $this->batches[] = $batch;
            $batch->setName($this);
        }

        return $this;
    }

    public function removeBatch(Batch $batch): self
    {
        if ($this->batches->removeElement($batch)) {
            // set the owning side to null (unless already changed)
            if ($batch->getName() === $this) {
                $batch->setName(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contains[]
     */
    public function getContains(): Collection
    {
        return $this->contains;
    }

    public function addContain(Contains $contain): self
    {
        if (!$this->contains->contains($contain)) {
            $this->contains[] = $contain;
            $contain->setName($this);
        }

        return $this;
    }

    public function removeContain(Contains $contain): self
    {
        if ($this->contains->removeElement($contain)) {
            // set the owning side to null (unless already changed)
            if ($contain->getName() === $this) {
                $contain->setName(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
