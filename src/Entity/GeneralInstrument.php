<?php

namespace App\Entity;

use App\Repository\GeneralInstrumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GeneralInstrumentRepository::class)
 */
class GeneralInstrument
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="text")
     */
    private $designation;

    /**
     * @ORM\OneToMany(targetEntity=SpecificInstrument::class, mappedBy="generalInstrument")
     */
    private $specifiques;

    public function __construct()
    {
        $this->specifiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * @return Collection|SpecificInstrument[]
     */
    public function getSpecifiques(): Collection
    {
        return $this->specifiques;
    }

    public function addSpecifique(SpecificInstrument $specifique): self
    {
        if (!$this->specifiques->contains($specifique)) {
            $this->specifiques[] = $specifique;
            $specifique->setGeneralInstrument($this);
        }

        return $this;
    }

    public function removeSpecifique(SpecificInstrument $specifique): self
    {
        if ($this->specifiques->contains($specifique)) {
            $this->specifiques->removeElement($specifique);
            // set the owning side to null (unless already changed)
            if ($specifique->getGeneralInstrument() === $this) {
                $specifique->setGeneralInstrument(null);
            }
        }

        return $this;
    }
}
