<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Address;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
        /**
         * If QueryBuilder is not initialized here, PHPStan gives error:
         * "Could not analyse QueryBuilder with unknown beginning."
         */
        $queryBuilder = $this->createQueryBuilder(self::QUERY_BUILDER_ALIAS)
        ->orderBy('address.name', 'DESC');

        if ($nameSearch !== null) {
               $queryBuilder->andWhere('address.name LIKE :name')
               ->setParameter('name', "%{$nameSearch}%");
        }

         return $queryBuilder->getQuery()->getResult();
    }
}
