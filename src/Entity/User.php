<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("email", message="Oh oh, this mail is already taken..")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=180, unique=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     *
     */
    private $password;

    /**
     * @ORM\Column (type="string", nullable=false, length=255)
     */
    private $lastName;

    /**
     * @ORM\Column (type="string", nullable=false, length=255)
     */
    private $firstName;

    /**
     * @ORM\Column (type="string", nullable=false, length=255, unique=true)
     */
    private $duckName;

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     * @Assert\Regex(
     *     pattern = "/https?:\/\/.*\.(?:png|jpg|gif)/",
     *     match = true
     * )
     */
    private $img;

    /**
     * @ORM\OneToMany(targetEntity=Quack::class, mappedBy="user")
     */
    private $quacks;

    public function __construct()
    {
        $this->quacks = new ArrayCollection();
    }


    public function getImg()
    {
        return $this->img;
    }


    public function setImg($img): void
    {
        $this->img = $img;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getDuckName()
    {
        return $this->duckName;
    }

    public function setDuckName($duckName): void
    {
        $this->duckName = $duckName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setId($id): void
    {
        $this->id = $id;
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
        $roles= $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
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
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }

    /**
     * @return Collection|Quack[]
     */
    public function getQuacks(): Collection
    {
        return $this->quacks;
    }

    public function addQuack(Quack $quack): self
    {
        if (!$this->quacks->contains($quack)) {
            $this->quacks[] = $quack;
            $quack->setUser($this);
        }

        return $this;
    }

    public function removeQuack(Quack $quack): self
    {
        if ($this->quacks->contains($quack)) {
            $this->quacks->removeElement($quack);
            // set the owning side to null (unless already changed)
            if ($quack->getUser() === $this) {
                $quack->setUser(null);
            }
        }

        return $this;
    }
}
