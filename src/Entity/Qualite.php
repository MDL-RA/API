<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\Qualite\AllQualite;
use App\Controller\Qualite\QualiteById;
use App\Repository\QualiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QualiteRepository::class)]
#[ORM\Table(name: "QUALITE")]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/qualite/{id}',
            controller: QualiteById::class,
            description: 'Récupére une qualité par son id',
            name: 'qualite',
        ),
        new GetCollection(
            controller:AllQualite::class,
            description: 'Récupére toutes les qualités',
            name:'allqualites'
        )
    ]
)]
class Qualite
{
     #[ORM\Column(name:"ID", type:"integer", nullable:false)]
     #[ORM\Id]
     #[ORM\GeneratedValue(strategy: "SEQUENCE")]
     #[ORM\SequenceGenerator(sequenceName: "QUALITE_ID_seq", allocationSize: 1, initialValue: 1)]
     private int $id;

    #[ORM\Column(name: "LIBELLEQUALITE", type: "string", length: 50, nullable: false)]
    private string $libellequalite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibellequalite(): ?string
    {
        return $this->libellequalite;
    }

    public function setLibellequalite(string $libellequalite): self
    {
        $this->libellequalite = $libellequalite;

        return $this;
    }


}
