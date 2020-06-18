<?php

namespace App\Entity;

use App\Repository\SpecificInstrumentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecificInstrumentRepository::class)
 */
class SpecificInstrument
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $minEtendu;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxEtendu;

   

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $unit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $precisionn;

    /**
     * @ORM\Column(type="integer")
     */
    private $frequenceCalibrage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resolution;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;
     /**
     * @ORM\Column(type="string")
     */
    private $numero;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMiseEnService;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serialNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $frequenceEtallonage;

    /**
     * @ORM\ManyToOne(targetEntity=GeneralInstrument::class, inversedBy="specifiques")
     */
    private $generalInstrument;

    /**
     * @ORM\ManyToOne(targetEntity=PosteTravail::class, inversedBy="specificInstruments")
     */
    private $poste;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="specificInstruments")
     */
    private $marque;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMinEtendu(): ?int
    {
        return $this->minEtendu;
    }

    public function setMinEtendu(int $minEtendu): self
    {
        $this->minEtendu = $minEtendu;

        return $this;
    }

    public function getMaxEtendu(): ?int
    {
        return $this->maxEtendu;
    }

    public function setMaxEtendu(int $maxEtendu): self
    {
        $this->maxEtendu = $maxEtendu;

        return $this;
    }

 

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getPrecisionn(): ?string
    {
        return $this->precisionn;
    }

    public function setPrecisionn(string $precisionn): self
    {
        $this->precisionn = $precisionn;

        return $this;
    }

    public function getFrequenceCalibrage(): ?int
    {
        return $this->frequenceCalibrage;
    }

    public function setFrequenceCalibrage(int $frequenceCalibrage): self
    {
        $this->frequenceCalibrage = $frequenceCalibrage;

        return $this;
    }

    public function getResolution(): ?string
    {
        return $this->resolution;
    }

    public function setResolution(string $resolution): self
    {
        $this->resolution = $resolution;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateMiseEnService(): ?\DateTimeInterface
    {
        return $this->dateMiseEnService;
    }

    public function setDateMiseEnService(\DateTimeInterface $dateMiseEnService): self
    {
        $this->dateMiseEnService = $dateMiseEnService;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getFrequenceEtallonage(): ?string
    {
        return $this->frequenceEtallonage;
    }

    public function setFrequenceEtallonage(string $frequenceEtallonage): self
    {
        $this->frequenceEtallonage = $frequenceEtallonage;

        return $this;
    }

    public function getGeneralInstrument(): ?GeneralInstrument
    {
        return $this->generalInstrument;
    }

    public function setGeneralInstrument(?GeneralInstrument $generalInstrument): self
    {
        $this->generalInstrument = $generalInstrument;

        return $this;
    }
    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPoste(): ?PosteTravail
    {
        return $this->poste;
    }

    public function setPoste(?PosteTravail $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }
}
