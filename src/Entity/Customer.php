<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}}
 * )
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @UniqueEntity(fields={"email"})
 */
class Customer implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Groups({"user:read", "user:write", "address:read"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"user:write", "user:read"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"user:read", "user:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"user:read", "user:write"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"user:read", "user:write"})
     */
    private $gsm;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user:read", "user:write"})
     */
    private $about = "how you describe this customer";

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"user:read", "user:write"})
     */
    private $sex;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     * @Groups({"user:read", "user:write"})
     */
    private $bday;
    private $fullname;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="customers", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user:read", "user:write", "address:write", "address:read"})
     * @Assert\Type(type="App\Entity\Address")
     * @Assert\Valid()
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Appointment::class, mappedBy="customerApp", cascade={"remove"})
     */
    private $appointments;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
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
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        //  nont needed when using bcrypt or argon
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {


        return ucfirst($this->name);
    }

    public function setName(string $name): self
    {

        $this->name = ucfirst($name);

        return $this;
    }

    public function getLastName(): ?string
    {
        return ucfirst($this->lastName);
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = ucfirst($lastName);

        return $this;
    }

    public function getFullName(string $firstName, string $lastName): ?string
    {
        return $this->fullname = $firstName . " " . $lastName;
    }

    public function getGsm(): ?string
    {
        return $this->gsm;
    }

    public function setGsm(string $gsm): self
    {

        $phoneCode = '+32';
        $fullNumber = substr_replace($gsm,$phoneCode,0,1);
        $this->gsm = $fullNumber;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = ucfirst($sex);

        return $this;
    }

    public function getBday(): ?\DateTimeInterface
    {
        return $this->bday;
    }

    public function setBday(\DateTimeInterface $bday): self
    {
        $this->bday = $bday;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Appointment[]
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setCustomerApp($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getCustomerApp() === $this) {
                $appointment->setCustomerApp(null);
            }
        }

        return $this;
    }

    public function __toString(){
        $a = $this->name;
        $b = $this->lastName;
        $f = $a . " " . $b;
        return $this->email . ", " . $f ;
    }


}
