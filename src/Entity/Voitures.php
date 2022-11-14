<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\VoituresRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: VoituresRepository::class)]
#[UniqueEntity(fields:['slug'],message:"Une autre annonce possède déjà ce titre, merci de la modifier")]
class Voitures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min:2, max:50, minMessage: "La marque doit faire plus de 2 caractères", maxMessage:'Le titre ne doit pas faire plus de 50 caractères ')]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min:2, max:50, minMessage: "Le modèle doit faire plus de 2 caractères", maxMessage:'Le titre ne doit pas faire plus de 50 caractères ')]
    private ?string $modele = null;

    #[ORM\Column(length: 255)]
    #[Assert\Image(mimeTypes:["image/png","image/jpeg","image/jpg"], mimeTypesMessage:"Vous devez upload un fichier jpg, jpeg ou png")]
    #[Assert\File(maxSize:"3024k", maxSizeMessage:"La taille du fichier est trop grande")]
    private ?string $image = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Vous devez renseigner le nombre de kilomètre du véhicule")]
    private ?int $km = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Vous devez renseigner le prix de vente du véhicule")]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $nbProprio = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Vous devez renseigner le nombre de cylindres de la voiture")]
    private ?int $cylindree = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: "Vous devez renseigner la puissance du véhicule (n° chevaux)")]
    private ?int $puissance = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Vous devez renseigner le type de carburant accepté par le véhicule")]
    private ?string $carburant = null;

    #[ORM\Column(type: Types::INTEGER)]
    #[Assert\Range(min: 1850, max:2030, notInRangeMessage: "Vous devez renseigner l'année de mise en circulation du véhicule")]
    private ?int $annee = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Vous devez renseigner si le voiture possède une boite manuelle ou automatique")]
    private ?string $transmission = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min:20, minMessage: "La description doit faire plus de 20 caractères")]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $options = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'voitureId', targetEntity: Pictures::class, )]
    private Collection $pictures;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }


    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function initializeSlug():void{
        if (empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->marque.''.$this->modele.''.$this->km);
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbProprio(): ?int
    {
        return $this->nbProprio;
    }

    public function setNbProprio(int $nbProprio): self
    {
        $this->nbProprio = $nbProprio;

        return $this;
    }

    public function getCylindree(): ?int
    {
        return $this->cylindree;
    }

    public function setCylindree(int $cylindree): self
    {
        $this->cylindree = $cylindree;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getAnnee():?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setVoitureId($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getVoitureId() === $this) {
                $picture->setVoitureId(null);
            }
        }

        return $this;
    }

    

    

   
}
