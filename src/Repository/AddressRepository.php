<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends \Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository<\App\Entity\Address>
 */
final class AddressRepository extends ServiceEntityRepository
{
    private const string QUERY_BUILDER_ALIAS = 'address';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Address::class);
    }

    /**
     * @return array<\App\Entity\Address> Returns an array of Address objects
     */
    public function findAllCustom(?string $nameSearch): array
    {
        $queryBuilder = $this->createOrderedByQueryBuilder();

        if ($nameSearch !== null) {
               $queryBuilder->andWhere('address.name LIKE :name')
               ->setParameter('name', "%{$nameSearch}%");
        }

//                ->andWhere('a.exampleField = :val')
//                ->setParameter('val', $value)
//                ->orderBy('a.id', 'ASC')
//                ->setMaxResults(10)
         return $queryBuilder->getQuery()->getResult();
    }

    //    public function findOneBySomeField($value): ?Address
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    private function createOrderedByQueryBuilder(?QueryBuilder $queryBuilder = null): QueryBuilder
    {
        $queryBuilder ??= $this->createQueryBuilder(self::QUERY_BUILDER_ALIAS);

        return $queryBuilder->orderBy('address.name', 'DESC');
    }
}
