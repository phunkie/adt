<?php declare(strict_types=1);

namespace Phunkie\ADT;

abstract class Sealed
{
    private $hasAlreadyBeenInstantiated = false;
    final protected function applySeal()
    {
        if ($this->hasAlreadyBeenInstantiated === true) {
            throw new \TypeError(get_class($this) .
                " has already been initiated \$obj->__construct(...) is disallowed.");
        }

        $this->hasAlreadyBeenInstantiated = true;

        if (!in_array(get_class($this), $this->sealedTo()))
        {
            throw new \TypeError(static::typeConstructor .
                " is sealed and cannot be extended outside seal.");
        }
    }

    final public function sealedTo(): array
    {
        return static::sealedTo;
    }
}