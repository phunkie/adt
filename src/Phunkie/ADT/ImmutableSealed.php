<?php

namespace Phunkie\ADT;

abstract class ImmutableSealed extends Sealed
{
    final public function __set($arg, $value)
    {
        if (isset($this->$arg)) {
            throw new \Error(get_class($this) . " is immutable");
        }
        throw new \Error("$arg is not a member of " . get_class($this));
    }

    final public function __get($arg)
    {
        if (isset($this->$arg)) {
            return $this->$arg;
        }
        throw new \Error("$arg is not a member of " . get_class($this));
    }
}