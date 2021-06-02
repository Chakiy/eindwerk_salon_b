<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"cost:read"}},
 *     denormalizationContext={"groups"={"cost:write"}}
 * )
 * @ORM\Entity(repositoryClass=CostRepository::class)
 */
class Cost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"cost:write", "cost:read"})
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"cost:write", "cost:read"})
     */
    private $cost;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="costs")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"cost:write", "cost:read"})
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

    public function getCost(): ?int
    {
        return $this->cost;
    }

    public function setCost(int $cost): self
    {
        $this->cost = $cost;

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

//    public function __toString(){
//        return $this->cost;
//    }
}
