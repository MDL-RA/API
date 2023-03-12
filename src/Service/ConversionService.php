<?php

namespace App\Service;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\String\ByteString;


class ConversionService
{
    public function __construct(private ObjectNormalizer $serializer, private readonly ContainerInterface $container){}

    /**
     * @throws ExceptionInterface
     */
    public function ArrayConversion($entity): array|string
    {
        $arr = [];
        foreach ($entity as $e)
        {
            try {
                $arr[] = $this->serializer->normalize($e);
            } catch (ExceptionInterface $e) {
                return ($e->getMessage());
            }
        }
        return $arr;
    }


    public function SingleConversion($entity): array|string
    {
        $arr = [];
            try {
                $arr[] = $this->serializer->normalize($entity);
            } catch (ExceptionInterface $e) {
                return ($e->getMessage());
            }
        return $arr;
    }


    public function toArray($data): array
    {
        $array = [
            'value' => $data
        ];
        return $array;
    }

    public function Encrypt($data) : array
    {
        $path= 'file://'.$this->container->getParameter('kernel.project_dir').'/config/keys/public.pem';
        $publicKey = openssl_pkey_get_public($path);
        $blockSize= 245;
        $blocks = str_split($data, $blockSize);
        $encryptedBlocks = [];
        foreach ($blocks as $block)
        {
            $encryptedBlock = '';
            openssl_public_encrypt($block, $encryptedBlock, $publicKey);
            $encryptedBlocks[] = $encryptedBlock;
        }
        $encryptedData = implode('', $encryptedBlocks);
        return $this->toArray(base64_encode($encryptedData));
    }



}