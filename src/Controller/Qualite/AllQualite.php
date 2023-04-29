<?php

namespace App\Controller\Qualite;

use App\Repository\LicencieRepository;
use App\Repository\QualiteRepository;
use App\Service\ConversionService;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

#[AsController]
class AllQualite extends AbstractController
{
    public function __construct(private QualiteRepository $qualiteRepository, private readonly ConversionService $convertionService){}

    /**
     * Méthode pour envoyer toutes les qualités chiffrées par l'URL au travers d'un JSON
     * @return array
     *@throws ExceptionInterface
     */
    public function __invoke($data): array
    {
        $arrConverted = json_encode($this->convertionService->ArrayConversion($data));
        return $this->convertionService->Encrypt($arrConverted);
    }
}