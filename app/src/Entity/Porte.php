<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\Portes\PortesDeleteCollectionController;
use App\Controller\Portes\PortesPostCollectionController;
use App\Repository\PorteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PorteRepository::class)]
#[ApiResource(
    operations: array(
        new Get(),
        new Post(),
        new Patch(),
        new Delete(
            uriTemplate: '/portes/collection',
            controller: PortesDeleteCollectionController::class,
            name: 'app_portes_delete_collection'
        ),
        new Delete(),
        new GetCollection(),
        new Post(
            uriTemplate: '/portes/collection',
            controller: PortesPostCollectionController::class,
            name: 'app_portes_post_collection'
        ),
    )
)]
class Porte
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $comments = null;

    #[ORM\Column(length: 255)]
    private ?int $version = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): void
    {
        $this->comments = $comments;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(?int $version): void
    {
        $this->version = $version;
    }
}
