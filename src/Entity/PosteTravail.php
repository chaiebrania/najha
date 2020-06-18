<?php

namespace App\Entity;

use App\Repository\PosteTravailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PosteTravailRepository::class)
 */
class PosteTravail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="PosteTravail")
     */
    private $section;

   

    /**
     * @ORM\OneToMany(targetEntity=SpecificInstrument::class, mappedBy="poste")
     */
    private $specificInstruments;

    public function __construct()
    {
      
        $this->specificInstruments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

   

    public function removeSpecificInstrument(SpecificInstrument $specificInstrument): self
    {
        if ($this->specificInstruments->contains($specificInstrument)) {
            $this->specificInstruments->removeElement($specificInstrument);
            // set the owning side to null (unless already changed)
            if ($specificInstrument->getPoste() === $this) {
                $specificInstrument->setPoste(null);
            }
        }

        return $this;
    }
}
