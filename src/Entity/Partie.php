<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="parties")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ResultatPartie", mappedBy="partie", orphanRemoval=true)
     */
    private $resultatParties;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->resultatParties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
        }

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|ResultatPartie[]
     */
    public function getResultatParties(): Collection
    {
        return $this->resultatParties;
    }

    public function addResultatParty(ResultatPartie $resultatParty): self
    {
        if (!$this->resultatParties->contains($resultatParty)) {
            $this->resultatParties[] = $resultatParty;
            $resultatParty->setPartie($this);
        }

        return $this;
    }

    public function removeResultatParty(ResultatPartie $resultatParty): self
    {
        if ($this->resultatParties->contains($resultatParty)) {
            $this->resultatParties->removeElement($resultatParty);
            // set the owning side to null (unless already changed)
            if ($resultatParty->getPartie() === $this) {
                $resultatParty->setPartie(null);
            }
        }

        return $this;
    }
}
