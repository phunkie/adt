<?php

namespace Phunkie\ADT;

trait ImmutableSealed
{
    use Sealed;
    public function __set($arg, $value)
    {
        if (isset($this->$arg)) {
            throw new \Error("{$this->type} is immutable");
        }
        throw new \Error("$arg is not a member of {$this->type}");
    }

    public function __get($arg)
    {
        if (isset($this->$arg)) {
            return $this->$arg;
        }
        throw new \Error("$arg is not a member of {$this->type}");
    }
}