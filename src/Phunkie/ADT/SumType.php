<?php declare(strict_types=1);

namespace Phunkie\ADT;

trait SumType
{
    public function getTypeConstructor(): ?string
    {
        return static::typeConstrutor ?? null;
    }
}