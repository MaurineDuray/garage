<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
class Pictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Url(message: "Veuillez rendre une url valide")]
    private ?string $file = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min:10, max:255, minMessage: "Le titre doit faire plus de 10 caractères", maxMessage:'Le titre ne doit pas faire plus de 255 caractères ')]
    private ?string $caption = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voitures $voitureId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getVoitureId(): ?Voitures
    {
        return $this->voitureId;
    }

    public function setVoitureId(?Voitures $voitureId): self
    {
        $this->voitureId = $voitureId;

        return $this;
    }
}
