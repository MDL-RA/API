<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\Licencie\AllLicencie;
use App\Controller\Licencie\LicencieById;
use App\Repository\LicencieRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: LicencieRepository::class)]
#[ORM\Table(name: "LICENCIE")]
#[ORM\UniqueConstraint(name: "uq_club", columns: ["NUMLICENCE"])]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/licencies/{numlicence}',
            controller: LicencieById::class,
            description: 'numéro du licencie',
            name: 'licencie',
        ),
        new GetCollection(
            controller:AllLicencie::class,
            description: 'récupérer tout les licencies',
            name:'allLicencie'
        )
    ]
)]
class Licencie
{

    #[ORM\Column(name: "ID", type: "integer", nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "SEQUENCE")]
    #[ORM\SequenceGenerator(sequenceName: "LICENCIE_ID_seq", allocationSize: 1, initialValue: 1)]
    #[ApiProperty(identifier: false)]
    private int $id;

 
    #[ORM\Column(name: "NUMLICENCE", type: "integer", nullable: false)]
    #[ApiProperty(identifier: true)]
    private int $numlicence;


    #[ORM\Column(name: "NOM", type: "string", length:70 , nullable: false)]
    private string $nom;

  
    #[ORM\Column(name: "PRENOM", type: "string", length:70 , nullable: false)]
    private string $prenom;


    #[ORM\Column(name: "ADRESSE1", type: "string", length:255 , nullable: false)]
    private string $adresse1;


    #[ORM\Column(name: "ADRESSE2", type: "string", length:255 , nullable: true)]
    private ?string $adresse2;

    #[ORM\Column(name: "CP", type: "string", length: 6, nullable: false, options: ["fixed" => true])]
    private string $cp;


    #[ORM\Column(name: "VILLE", type: "string", length:70 , nullable: false)]
    private string $ville;


    #[ORM\Column(name: "TEL", type: "string", length: 14, nullable: false, options: ["fixed" => true])]
    private string $tel;


    #[ORM\Column(name: "MAIL", type: "string", length:100 , nullable: false)]
    private string $mail;

    #[ORM\Column(name: "DATEADHESION", type: "datetime", nullable: false)]
    private DateTime $dateadhesion;

    #[ORM\Column(name: "IDCLUB", type: "integer", nullable: false)]
    private int $idclub;

    #[ORM\Column(name: "IDQUALITE", type: "integer", nullable: false)]
    private int $idqualite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumlicence(): ?int
    {
        return $this->numlicence;
    }

    public function setNumlicence(int $numlicence): self
    {
        $this->numlicence = $numlicence;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse1(): ?string
    {
        return $this->adresse1;
    }

    public function setAdresse1(string $adresse1): self
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->adresse2;
    }

    public function setAdresse2(?string $adresse2): self
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDateadhesion(): ?\DateTimeInterface
    {
        return $this->dateadhesion;
    }

    public function setDateadhesion(\DateTimeInterface $dateadhesion): self
    {
        $this->dateadhesion = DateTime::createFromFormat('d/m/Y',$dateadhesion);

        return $this;
    }

    public function getIdclub(): ?int
    {
        return $this->idclub;
    }

    public function setIdclub(int $idclub): self
    {
        $this->idclub = $idclub;

        return $this;
    }

    public function getIdqualite(): ?int
    {
        return $this->idqualite;
    }

    public function setIdqualite(int $idqualite): self
    {
        $this->idqualite = $idqualite;

        return $this;
    }


}
