<?php

namespace App\Service;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\DependencyInjection\ContainerInterface;



class ConversionService
{
    public function __construct(private ObjectNormalizer $serializer, private readonly ContainerInterface $container){}

    /**
     * Méthode permettant de convertir un tableau d'objet en tableau associatif
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


    /**
     * Méthode permettant de convertir un objet en une chaine de caractère
     * @param $entity
     * @return array|string
     */
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


    /**
     * Méthode permettant de créer un tableau à partir des données passées en paramètre
     * @param $data
     * @return array
     */
    public function toArray($data): array
    {
        $array = [
            'value' => $data
        ];
        return $array;
    }

    /**
     * Méthode permettant de chiffrer les données passées en paramètre
     * @param $data
     * @return array
     */
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