<?php

namespace App\Repository;

use App\Entity\Licencie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Licencie>
 *
 * @method Licencie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Licencie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Licencie[]    findAll()
 * @method Licencie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LicencieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Licencie::class);
    }

    public function save(Licencie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Licencie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findByNumLicencie($value)
    {
        dd($value);
        return $this->createQueryBuilder('l')
            ->andWhere('l.numlicence = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    public function findOneBySomeField($value): ?Test
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
