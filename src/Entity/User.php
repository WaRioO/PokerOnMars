<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UserName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Partie", mappedBy="user")
     */
    private $parties;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $estPom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ResultatPartie", mappedBy="user", orphanRemoval=true)
     */
    private $resultatParties;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
        $this->resultatParties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function setUserName(string $UserName): self
    {
        $this->UserName = $UserName;

        return $this;
    }

    /**
     * @return Collection|Partie[]
     */
    public function getParties(): Collection
    {
        return $this->parties;
    }

    public function addParty(Partie $party): self
    {
        if (!$this->parties->contains($party)) {
            $this->parties[] = $party;
            $party->addUser($this);
        }

        return $this;
    }

    public function removeParty(Partie $party): self
    {
        if ($this->parties->contains($party)) {
            $this->parties->removeElement($party);
            $party->removeUser($this);
        }

        return $this;
    }

    public function getEstPom(): ?bool
    {
        return $this->estPom;
    }

    public function setEstPom(?bool $estPom): self
    {
        $this->estPom = $estPom;

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
            $resultatParty->setUser($this);
        }

        return $this;
    }

    public function removeResultatParty(ResultatPartie $resultatParty): self
    {
        if ($this->resultatParties->contains($resultatParty)) {
            $this->resultatParties->removeElement($resultatParty);
            // set the owning side to null (unless already changed)
            if ($resultatParty->getUser() === $this) {
                $resultatParty->setUser(null);
            }
        }

        return $this;
    }
}
