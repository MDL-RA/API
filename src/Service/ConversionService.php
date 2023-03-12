<?php

namespace App\Service;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ConvertionService
{
    public function __construct(private ObjectNormalizer $serializer){}

    /**
     * @throws ExceptionInterface
     */
    public function conversion($entity): array|string
    {
        $arr = [];
        foreach ($entity as $e){
            try {
                $arr[] = $this->serializer->normalize($e);
            } catch (ExceptionInterface $e) {
                return ($e->getMessage());
            }
        }
        return $arr;
    }
}