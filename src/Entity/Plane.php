<?php

namespace App\Entity;

use App\Repository\PlaneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlaneRepository::class)
 */
class Plane
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
    public $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $boardNumber;

    /**
     * @ORM\Column(type="date")
     */
    public $releaseDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $releasePlace;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public $fixDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $fixPlace;

    /**
     * @ORM\Column(type="integer")
     */
    public $exploTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $fixExploTime;

    /**
     * @ORM\Column(type="integer")
     */
    public $startingExploTime;

    /**
     * @ORM\Column(type="integer")
     */
    public $FlyTime;

    /**
     * @ORM\Column(type="integer")
     */
    public $sitDowns;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $countFails;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public $include;

    /**
     * @ORM\OneToMany(targetEntity=Remont::class, mappedBy="planeId")
     */
    public $remontId;

    /**
     * @ORM\OneToMany(targetEntity=EffExplo::class, mappedBy="planeId")
     */
    public $effExploId;

    /**
     * @ORM\OneToMany(targetEntity=FlyOut::class, mappedBy="planeId")
     */
    public $flyOutId;

    public function __construct()
    {
        $this->remontId = new ArrayCollection();
        $this->effExploId = new ArrayCollection();
        $this->flyOutId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getBoardNumber(): ?string
    {
        return $this->boardNumber;
    }

    public function setBoardNumber(string $boardNumber): self
    {
        $this->boardNumber = $boardNumber;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getReleasePlace(): ?string
    {
        return $this->releasePlace;
    }

    public function setReleasePlace(string $releasePlace): self
    {
        $this->releasePlace = $releasePlace;

        return $this;
    }

    public function getFixDate(): ?\DateTimeInterface
    {
        return $this->fixDate;
    }

    public function setFixDate(?\DateTimeInterface $fixDate): self
    {
        $this->fixDate = $fixDate;

        return $this;
    }

    public function getFixPlace(): ?string
    {
        return $this->fixPlace;
    }

    public function setFixPlace(?string $fixPlace): self
    {
        $this->fixPlace = $fixPlace;

        return $this;
    }

    public function getExploTime(): ?int
    {
        return $this->exploTime;
    }

    public function setExploTime(int $exploTime): self
    {
        $this->exploTime = $exploTime;

        return $this;
    }

    public function getFixExploTime(): ?int
    {
        return $this->fixExploTime;
    }

    public function setFixExploTime(?int $fixExploTime): self
    {
        $this->fixExploTime = $fixExploTime;

        return $this;
    }

    public function getStartingExploTime(): ?int
    {
        return $this->startingExploTime;
    }

    public function setStartingExploTime(int $startingExploTime): self
    {
        $this->startingExploTime = $startingExploTime;

        return $this;
    }

    public function getFlyTime(): ?int
    {
        return $this->FlyTime;
    }

    public function setFlyTime(int $FlyTime): self
    {
        $this->FlyTime = $FlyTime;

        return $this;
    }

    public function getSitDowns(): ?int
    {
        return $this->sitDowns;
    }

    public function setSitDowns(int $sitDowns): self
    {
        $this->sitDowns = $sitDowns;

        return $this;
    }

    public function getCountFails(): ?int
    {
        return $this->countFails;
    }

    public function setCountFails(?int $countFails): self
    {
        $this->countFails = $countFails;

        return $this;
    }

    public function getInclude(): ?bool
    {
        return $this->include;
    }

    public function setInclude(?bool $include): self
    {
        $this->include = $include;

        return $this;
    }

    /**
     * @return Collection|remont[]
     */
    public function getRemontId(): Collection
    {
        return $this->remontId;
    }

    public function addRemontId(remont $remontId): self
    {
        if (!$this->remontId->contains($remontId)) {
            $this->remontId[] = $remontId;
            $remontId->setPlaneId($this);
        }

        return $this;
    }

    public function removeRemontId(remont $remontId): self
    {
        if ($this->remontId->removeElement($remontId)) {
            // set the owning side to null (unless already changed)
            if ($remontId->getPlaneId() === $this) {
                $remontId->setPlaneId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EffExplo[]
     */
    public function getEffExploId(): Collection
    {
        return $this->effExploId;
    }

    public function addEffExploId(EffExplo $effExploId): self
    {
        if (!$this->effExploId->contains($effExploId)) {
            $this->effExploId[] = $effExploId;
            $effExploId->setPlaneId($this);
        }

        return $this;
    }

    public function removeEffExploId(EffExplo $effExploId): self
    {
        if ($this->effExploId->removeElement($effExploId)) {
            // set the owning side to null (unless already changed)
            if ($effExploId->getPlaneId() === $this) {
                $effExploId->setPlaneId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FlyOut[]
     */
    public function getFlyOutId(): Collection
    {
        return $this->flyOutId;
    }

    public function addFlyOutId(FlyOut $flyOutId): self
    {
        if (!$this->flyOutId->contains($flyOutId)) {
            $this->flyOutId[] = $flyOutId;
            $flyOutId->setPlaneId($this);
        }

        return $this;
    }

    public function removeFlyOutId(FlyOut $flyOutId): self
    {
        if ($this->flyOutId->removeElement($flyOutId)) {
            // set the owning side to null (unless already changed)
            if ($flyOutId->getPlaneId() === $this) {
                $flyOutId->setPlaneId(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}
