<?php

namespace App\Entity;

use App\Repository\EffExploRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EffExploRepository::class)
 */
class EffExplo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $state;

    /**
     * @ORM\Column(type="integer")
     */
    public $timeOfState;

    /**
     * @ORM\ManyToOne(targetEntity=Plane::class, inversedBy="effExploId")
     * @ORM\JoinColumn(nullable=false)
     */
    public $planeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getTimeOfState(): ?int
    {
        return $this->timeOfState;
    }

    public function setTimeOfState(int $timeOfState): self
    {
        $this->timeOfState = $timeOfState;

        return $this;
    }

    public function getPlaneId(): ?Plane
    {
        return $this->planeId;
    }

    public function setPlaneId(?Plane $planeId): self
    {
        $this->planeId = $planeId;

        return $this;
    }
}
