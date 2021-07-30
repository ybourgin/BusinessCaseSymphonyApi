<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GarageRepository::class)
 */
class Garage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annonce:get"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"annonce:get"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=14)
     * @Groups({"annonce:get"})
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"annonce:get"})
     */
    private $adresseLigne1;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"annonce:get"})
     */
    private $adresseLigne2;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"annonce:get"})
     */
    private $adresseLigne3;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"annonce:get"})
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"annonce:get"})
     */
    private $codePostal;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="garage")
     */
    private $annonces;

    /**
     * @ORM\ManyToOne(targetEntity=Professionnel::class, inversedBy="garages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $professionnel;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getAdresseLigne1(): ?string
    {
        return $this->adresseLigne1;
    }

    public function setAdresseLigne1(string $adresseLigne1): self
    {
        $this->adresseLigne1 = $adresseLigne1;

        return $this;
    }

    public function getAdresseLigne2(): ?string
    {
        return $this->adresseLigne2;
    }

    public function setAdresseLigne2(?string $adresseLigne2): self
    {
        $this->adresseLigne2 = $adresseLigne2;

        return $this;
    }

    public function getAdresseLigne3(): ?string
    {
        return $this->adresseLigne3;
    }

    public function setAdresseLigne3(?string $adresseLigne3): self
    {
        $this->adresseLigne3 = $adresseLigne3;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setGarage($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getGarage() === $this) {
                $annonce->setGarage(null);
            }
        }

        return $this;
    }

    public function getProfessionnel(): ?Professionnel
    {
        return $this->professionnel;
    }

    public function setProfessionnel(?Professionnel $professionnel): self
    {
        $this->professionnel = $professionnel;

        return $this;
    }
}
