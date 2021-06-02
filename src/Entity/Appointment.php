<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get","delete"},
 *
 *     normalizationContext={"groups"={"app:read"}},
 *     denormalizationContext={"groups"={"app:write"}}
 * )
 * @ORM\Entity(repositoryClass=AppointmentRepository::class)
 */
class Appointment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"app:write", "app:read"})
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     * @Groups({"app:write", "app:read"})
     */
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"app:read", "app:write"})
     */
    private $customerApp;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="appointments")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"app:read", "app:write"})
     */
    private $service;

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

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getCustomerApp(): ?Customer
    {
        return $this->customerApp;
    }

    public function setCustomerApp(?Customer $customerApp): self
    {
        $this->customerApp = $customerApp;

        return $this;
    }

    public function getService(): ?Services
    {
        return $this->service;
    }

    public function setService(?Services $service): self
    {
        $this->service = $service;

        return $this;
    }


    public function __toString(){
        return $this->date;
    }

}
