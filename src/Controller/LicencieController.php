<?php

namespace App\Controller;

use App\Repository\LicencieRepository;
use App\Service\ConversionService;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

#[AsController]
class LicencieController extends AbstractController
{
    public function __construct(private LicencieRepository $licencieRepository, private ConversionService $convertionService){}

    /**
     * @throws ExceptionInterface
     */
    public function __invoke($numLicencie): string
    {
        $arr =  $this->licencieRepository->findByNumLicencie($numLicencie);
        $arrConverted = $this->convertionService->conversion($arr);
        dd($arr);
        $key = getenv('JWT_SECRET_KEY');
        return JWT::encode($arrConverted, strval($key), 'HS256');
    }
}