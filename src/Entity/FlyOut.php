<?php

namespace App\Entity;

use App\Repository\FlyOutRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FlyOutRepository::class)
 */
class FlyOut
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="date")
     */
    public $date;

    /**
     * @ORM\Column(type="integer")
     */
    public $flyingTime;

    /**
     * @ORM\Column(type="integer")
     */
    public $timeBeforeFly;

    /**
     * @ORM\ManyToOne(targetEntity=Plane::class, inversedBy="flyOutId")
     * @ORM\JoinColumn(nullable=false)
     */
    public $planeId;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $flyFail;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFlyingTime(): ?int
    {
        return $this->flyingTime;
    }

    public function setFlyingTime(int $flyingTime): self
    {
        $this->flyingTime = $flyingTime;

        return $this;
    }

    public function getTimeBeforeFly(): ?int
    {
        return $this->timeBeforeFly;
    }

    public function setTimeBeforeFly(int $timeBeforeFly): self
    {
        $this->timeBeforeFly = $timeBeforeFly;

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

    public function getFlyFail(): ?bool
    {
        return $this->flyFail;
    }

    public function setFlyFail(?bool $flyFail): self
    {
        $this->flyFail = $flyFail;

        return $this;
    }
}
