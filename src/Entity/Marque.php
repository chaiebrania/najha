<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
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
     * @ORM\OneToMany(targetEntity=SpecificInstrument::class, mappedBy="marque")
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

   

 

    

    /**
     * @return Collection|SpecificInstrument[]
     */
    public function getSpecificInstruments(): Collection
    {
        return $this->specificInstruments;
    }

    public function addSpecificInstrument(SpecificInstrument $specificInstrument): self
    {
        if (!$this->specificInstruments->contains($specificInstrument)) {
            $this->specificInstruments[] = $specificInstrument;
            $specificInstrument->setMarque($this);
        }

        return $this;
    }

    public function removeSpecificInstrument(SpecificInstrument $specificInstrument): self
    {
        if ($this->specificInstruments->contains($specificInstrument)) {
            $this->specificInstruments->removeElement($specificInstrument);
            // set the owning side to null (unless already changed)
            if ($specificInstrument->getMarque() === $this) {
                $specificInstrument->setMarque(null);
            }
        }

        return $this;
    }
}
