<?php

namespace App\Controller\Licencie;

use App\Repository\LicencieRepository;
use App\Service\ConversionService;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

#[AsController]
class AllLicencie extends AbstractController
{
    public function __construct(private LicencieRepository $licencieRepository, private ConversionService $convertionService){}

    /**
     * @return array
     *@throws ExceptionInterface
     */
    public function __invoke($data): array
    {
        $arrConverted = json_encode($this->convertionService->ArrayConversion($data));
        return $this->convertionService->Encrypt($arrConverted);
    }
}