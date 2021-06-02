<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"address:read"}},
 *     denormalizationContext={"groups"={"address:write"}}
 * )
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"address:write", "address:read", "user:read", "user:write"})
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"address:write", "address:read", "user:read", "user:write"})
     */
    private $streetNr;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"address:write", "address:read", "user:read", "user:write"})
     */
    private $zipCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Groups({"address:write", "address:read", "user:read", "user:write"})
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity=Customer::class, mappedBy="address", cascade={"remove"})
     */
    private $customers;

    public function __construct()
    {
        $this->customers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = ucfirst($street);

        return $this;
    }

    public function getStreetNr(): ?string
    {
        return $this->streetNr;
    }

    public function setStreetNr(string $streetNr): self
    {
        $this->streetNr = $streetNr;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = ucfirst($city);

        return $this;
    }

    /**
     * @return Collection|Customer[]
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers[] = $customer;
            $customer->setAddress($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getAddress() === $this) {
                $customer->setAddress(null);
            }
        }

        return $this;
    }

    public function __toString(){
        $st = $this->street;
        $stNr = $this->streetNr;
        $code = $this->zipCode;
        $city = $this->city;

        return $st . " - " . $stNr . " - " . $code . " - " . $city;
    }
}
