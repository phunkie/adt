<?php declare(strict_types=1);

namespace Phunkie\ADT;

trait SumType
{
    private static $checkedFor = [];
    public function getTypeConstructor(): ?string
    {
        return static::typeConstrutor ?? null;
    }

    public static function markChecked(string $hash)
    {
        self::$checkedFor[static::class . $hash] = true;
    }

    public static function isChecked(string $hash)
    {
        return array_key_exists(static::class . $hash, self::$checkedFor) &&
            self::$checkedFor[static::class . $hash] === true;
    }
}