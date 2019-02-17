<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\Image(
     *     mimeTypes={"image/png","image/jpeg"},
     *     mimeTypesMessage="Formats image acceptés : PNG & JPG",
     *     maxSize="4M",
     *     maxSizeMessage="Le fichier ne peut pas dépasser 4M",
     *     allowSquare=false,
     *     allowPortrait=false,
     *     allowSquareMessage="Ajouter une photo au format paysage",
     *     allowPortraitMessage="Ajouter une photo au format paysage",
     *     minWidth=600,
     *     minWidthMessage="L'image doit avoir une largeur de minimum 600 pixels",
     *     minHeight=450,
     *     minHeightMessage="L'image doit avoir une hauteur de minimum 450 pixels",
     *     minRatio=1.2,
     *     minRatioMessage="Largeur divisé par Hauteur doit être supérieure à 1,2",
     *     maxRatio=1.5,
     *     maxRatioMessage="Largeur divisé par Hauteur doit être inférieur à 1,5"
     * )
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=200)
     * @Assert\NotBlank(message="Veuillez saisir un titre")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=4000)
     * @Assert\NotBlank(message="Veuillez saisir un contenu")
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateParution;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDateParution(): ?\DateTimeInterface
    {
        return $this->DateParution;
    }

    public function setDateParution(\DateTimeInterface $DateParution): self
    {
        $this->DateParution = $DateParution;

        return $this;
    }

    public function __construct()
    {
        $this->setDateParution(new \DateTime());
    }
}
