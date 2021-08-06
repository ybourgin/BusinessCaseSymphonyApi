<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *    collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_USER')"
 *          }
 *      },
 *      itemOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ADMIN') or object.annonce.garage.professionnel == user"
 *          },
 *          "delete"={
 *              "security"="is_granted('ROLE_ADMIN') or object.annonce.garage.professionnel == user"
 *          },
 *          "patch"={
 *              "security"="is_granted('ROLE_ADMIN') or object.annonce.garage.professionnel == user"
 *          }
 *      },
 *
 *     normalizationContext={
 *          "groups"={"image:get"}
 *      }
 * )
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("image:get")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"annonce:get","image:get"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annonce:get","image:get"})
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"annonce:get"})
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $taille;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Annonce::class, inversedBy="images")
     */
    private $annonce;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

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

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): self
    {
        $this->taille = $taille;

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

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}
