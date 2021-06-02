<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 * @Vich\Uploadable()
 */
class Images
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    public $updatedAt;

    /**
     * @Vich\UploadableField(mapping="service", fileNameProperty="name")
     */
    private $nameFile;

    /**
     * @param mixed $id
     */
    public function __construct()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     * @return File|null
     */
    public function getNameFile(): ?File
    {
        return $this->nameFile;
    }

    /**
     * @param mixed $nameFile
     */
    public function setNameFile(?File $nameFile  = null): void
    {
        $this->nameFile = $nameFile;
        if ($nameFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime();
        }
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * @return string|null $naam
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }





}
