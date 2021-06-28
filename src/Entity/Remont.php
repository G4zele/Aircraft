<?php

namespace App\Entity;

use App\Repository\RemontRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RemontRepository::class)
 */
class Remont
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $timeOnTO;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $timeOnOperTO;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $timeOfMidRem;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $timeDir;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $timeYstr;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $trudDop;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $trudMain;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $trudDeMont;

    /**
     * @ORM\ManyToOne(targetEntity=Plane::class, inversedBy="remontId")
     * @ORM\JoinColumn(nullable=false)
     */
    public $planeId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $timeOnKapRem;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTimeOnTO(): ?int
    {
        return $this->timeOnTO;
    }

    public function setTimeOnTO(?int $timeOnTO): self
    {
        $this->timeOnTO = $timeOnTO;

        return $this;
    }

    public function getTimeOnOperTO(): ?int
    {
        return $this->timeOnOperTO;
    }

    public function setTimeOnOperTO(?int $timeOnOperTO): self
    {
        $this->timeOnOperTO = $timeOnOperTO;

        return $this;
    }

    public function getTimeOfMidRem(): ?int
    {
        return $this->timeOfMidRem;
    }

    public function setTimeOfMidRem(?int $timeOfMidRem): self
    {
        $this->timeOfMidRem = $timeOfMidRem;

        return $this;
    }

    public function getTimeDir(): ?int
    {
        return $this->timeDir;
    }

    public function setTimeDir(?int $timeDir): self
    {
        $this->timeDir = $timeDir;

        return $this;
    }

    public function getTimeYstr(): ?int
    {
        return $this->timeYstr;
    }

    public function setTimeYstr(?int $timeYstr): self
    {
        $this->timeYstr = $timeYstr;

        return $this;
    }

    public function getTrudDop(): ?int
    {
        return $this->trudDop;
    }

    public function setTrudDop(?int $trudDop): self
    {
        $this->trudDop = $trudDop;

        return $this;
    }

    public function getTrudMain(): ?int
    {
        return $this->trudMain;
    }

    public function setTrudMain(?int $trudMain): self
    {
        $this->trudMain = $trudMain;

        return $this;
    }

    public function getTrudDeMont(): ?int
    {
        return $this->trudDeMont;
    }

    public function setTrudDeMont(?int $trudDeMont): self
    {
        $this->trudDeMont = $trudDeMont;

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

    public function getTimeOnKapRem(): ?int
    {
        return $this->timeOnKapRem;
    }

    public function setTimeOnKapRem(?int $timeOnKapRem): self
    {
        $this->timeOnKapRem = $timeOnKapRem;

        return $this;
    }
}
