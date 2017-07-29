<?php declare(strict_types=1);

namespace Phunkie\ADT;

trait Sealed
{
    private $hasAlreadyBeenInstantiated = false;
    final protected function __construct(...$constructionArguments)
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

    static public function new(...$args)
    {
        $sumType = new static();
        foreach ($args as $key => $value) {
            $sumType->$key = $value;
        }
        return $sumType;
    }

    public function sealedTo(): array
    {
        return static::sealedTo;
    }
}