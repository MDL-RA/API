<?php

namespace App\Controller\Club;

use App\Repository\ClubRepository;
use App\Repository\LicencieRepository;
use App\Service\ConversionService;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

#[AsController]
class ClubById extends AbstractController
{
    public function __construct(private ClubRepository $clubRepository, private readonly ConversionService $convertionService){}

    /**
     * @return array
     *@throws ExceptionInterface
     */
    public function __invoke($data): array
    {
        $arrConverted = json_encode($this->convertionService->SingleConversion($data));
        return $this->convertionService->Encrypt($arrConverted);
    }
}