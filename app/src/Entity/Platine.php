<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\Platines\PlatinesVisioGetController;
use App\Controller\Platines\PlatinesVisioPostController;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ApiResource(
    operations: array(
        new Get(
            uriTemplate: '/platines/visio/{id}',
            controller: PlatinesVisioGetController::class,
            read: false,
            name: 'app_platines_visio_get'
        ),
        new Get(),
        new Post(),
        new Post(
            uriTemplate: '/platines/visio',
            controller: PlatinesVisioPostController::class,
            name: 'app_platines_visio_post'
        ),
        new Patch(),
        new Delete(),
        new GetCollection()
    )
)]
class Platine
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private int $code;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\Column]
    private int $number;

    #[ORM\Column]
    private int $serialNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    public function getSerialNumber(): int
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(int $serialNumber): void
    {
        $this->serialNumber = $serialNumber;
    }
}
