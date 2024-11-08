<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enum\ThingType;
use App\Model\Thing;
use Psr\Log\LoggerInterface;

use function count;

final class ThingRepository
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function find(int $id): ?Thing
    {
        foreach ($this->findAll() as $thing) {
            if ($thing->getId() === $id) {
                return $thing;
            }
        }

        return null;
    }

    /**
     * @return array<int,\App\Model\Thing>
     */
    public function findAll(): array
    {
        $this->logger->info('get collection');

        return [
            new Thing(1, 'name1', 'description1', ThingType::Thing),
            new Thing(2, 'name2', 'description2', ThingType::Stuff),
            new Thing(3, 'name3', 'description3', ThingType::Stuff),
        ];
    }

    public function getTotal(): int
    {
        return count($this->findAll());
    }
}
