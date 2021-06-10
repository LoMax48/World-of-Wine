<?php

namespace App\Entity;

use App\Repository\FridgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FridgeRepository::class)
 */
class Fridge
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
    private $capacity;

    /**
     * @ORM\Column(type="integer")
     */
    private $temperature;

    /**
     * @ORM\OneToMany(targetEntity=Batch::class, mappedBy="fridge")
     */
    private $batches;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="fridges")
     */
    private $worker;

    public function __construct()
    {
        $this->batches = new ArrayCollection();
        $this->worker = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): self
    {
        $this->temperature = $temperature;

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
            $batch->setFridge($this);
        }

        return $this;
    }

    public function removeBatch(Batch $batch): self
    {
        if ($this->batches->removeElement($batch)) {
            // set the owning side to null (unless already changed)
            if ($batch->getFridge() === $this) {
                $batch->setFridge(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getWorker(): Collection
    {
        return $this->worker;
    }

    public function addWorker(User $worker): self
    {
        if (!$this->worker->contains($worker)) {
            $this->worker[] = $worker;
        }

        return $this;
    }

    public function removeWorker(User $worker): self
    {
        $this->worker->removeElement($worker);

        return $this;
    }

    public function __toString()
    {
        return (string) "№" . $this->id . ", " . $this->capacity . ", " . $this->temperature . "°C";
    }
}
