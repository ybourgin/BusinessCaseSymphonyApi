<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"annonce:get_lite"}
 *              }
 *          },
 *          "post"={"security"="is_granted('ROLE_USER')"},
 *      },
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"annonce:get"}
 *              }
 *          },
 *          "patch"={"security"="is_granted('ROLE_ADMIN') or object.garage.professionnel == user"},
 *          "delete"={"security"="is_granted('ROLE_ADMIN') or object.garage.professionnel == user"},
 *      },
 * )
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 * @ApiFilter(SearchFilter::class, properties={"modele.marque.nom","modele.nom","categorieVoitures.nom","carburant.type"})
 * @ApiFilter(NumericFilter::class, properties={"prix","kilometrage","annee","reference"})
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $titre;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $annee;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"annonce:get"})
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Groups({"annonce:get"})
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"annonce:get"})
     */
    private $estManuelle;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $modele;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="annonce")
     * @Groups({"annonce:get"})
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity=CategorieVoiture::class, inversedBy="annonces")
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $categorieVoitures;

    /**
     * @ORM\ManyToOne(targetEntity=Carburant::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"annonce:get", "annonce:get_lite"})
     */
    private $carburant;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"annonce:get"})
     */
    private $garage;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categorieVoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(int $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getEstManuelle(): ?bool
    {
        return $this->estManuelle;
    }

    public function setEstManuelle(?bool $estManuelle): self
    {
        $this->estManuelle = $estManuelle;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAnnonce($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAnnonce() === $this) {
                $image->setAnnonce(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategorieVoiture[]
     */
    public function getCategorieVoitures(): Collection
    {
        return $this->categorieVoitures;
    }

    public function addCategorieVoiture(CategorieVoiture $categorieVoiture): self
    {
        if (!$this->categorieVoitures->contains($categorieVoiture)) {
            $this->categorieVoitures[] = $categorieVoiture;
        }

        return $this;
    }

    public function removeCategorieVoiture(CategorieVoiture $categorieVoiture): self
    {
        $this->categorieVoitures->removeElement($categorieVoiture);

        return $this;
    }

    public function getCarburant(): ?Carburant
    {
        return $this->carburant;
    }

    public function setCarburant(?Carburant $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }
}
