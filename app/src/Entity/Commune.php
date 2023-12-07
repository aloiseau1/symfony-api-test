<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\Communes\CommunesGetByCodeController;
use App\Controller\Communes\CommunesGetByZipCodeController;
use App\Controller\Communes\CommunesGetController;

#[ApiResource(
    operations: array(
        new Get(
            uriTemplate: '/communes/{code}',
            controller: CommunesGetByCodeController::class,
            read: false,
            name: 'app_communes_get_by_code'
        ),
        new Get(
            uriTemplate: '/communes/zipcode/{zipcode}',
            controller: CommunesGetByZipCodeController::class,
            read: false,
            name: 'app_communes_get_by_zip_code'
        ),
        new GetCollection(
            uriTemplate: '/communes',
            controller: CommunesGetController::class,
            read: false,
            name: 'app_communes_get'
        ),
    )
)]
class Commune
{
    private string $code;

    private ?string $nom = null;

    private ?string $siren = null;

    private ?string $codeDepartement = null;

    /**
     * @var string[]|null
     */
    private ?array $codesPostaux = null;

    private ?int $population = null;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): void
    {
        $this->siren = $siren;
    }

    public function getCodeDepartement(): ?string
    {
        return $this->codeDepartement;
    }

    public function setCodeDepartement(?string $codeDepartement): void
    {
        $this->codeDepartement = $codeDepartement;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(?int $population): void
    {
        $this->population = $population;
    }
}
