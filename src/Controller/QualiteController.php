<?php

namespace App\Controller;

use App\Entity\Qualite;
use App\Repository\QualiteRepository;
use App\Service\ConvertionService;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[AsController]
class QualiteController extends AbstractController
{
    public function __construct(private QualiteRepository $qualiteRepository, private ConvertionService $convertionService){}
    public function __invoke ($data): string
    {
        $arr =  $this->qualiteRepository->findAll();
        $arrConverted = $this->convertionService->convertion($arr);
        $key = getenv('JWT_SECRET_KEY');
        return JWT::encode($arrConverted,strval($key),'HS256');
    }
}