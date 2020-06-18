<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectionRepository::class)
 */
class Section
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
     * @ORM\OneToMany(targetEntity=PosteTravail::class, mappedBy="section")
     */
    private $PosteTravail;

    public function __construct()
    {
        $this->PosteTravail = new ArrayCollection();
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
     * @return Collection|PosteTravail[]
     */
    public function getPosteTravail(): Collection
    {
        return $this->PosteTravail;
    }

    public function addPosteTravail(PosteTravail $posteTravail): self
    {
        if (!$this->PosteTravail->contains($posteTravail)) {
            $this->PosteTravail[] = $posteTravail;
            $posteTravail->setSection($this);
        }

        return $this;
    }

    public function removePosteTravail(PosteTravail $posteTravail): self
    {
        if ($this->PosteTravail->contains($posteTravail)) {
            $this->PosteTravail->removeElement($posteTravail);
            // set the owning side to null (unless already changed)
            if ($posteTravail->getSection() === $this) {
                $posteTravail->setSection(null);
            }
        }

        return $this;
    }
}
