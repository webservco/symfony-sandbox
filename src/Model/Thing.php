<?php

declare(strict_types=1);

namespace App\Model;

use App\Enum\ThingType;

final class Thing
{
    public function __construct(
        private int $id,
        private string $name,
        private string $description,
        private ThingType $type,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getType(): ThingType
    {
        return $this->type;
    }
}
