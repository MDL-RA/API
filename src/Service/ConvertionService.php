<?php

namespace App\Service;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class ConvertionService
{
    public function __construct(private ObjectNormalizer $serializer){}
    public function convertion($entity): array
    {
        $arr = [];
        foreach ($entity as $e){
            $arr[]= $this->serializer->normalize($e);
        }
        return $arr;
    }
}