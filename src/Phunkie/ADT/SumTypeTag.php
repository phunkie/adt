<?php

namespace Phunkie\ADT;

interface SumTypeTag
{
    /**
     * @param string $hash the match hash
     * @return array of SumTypes not included in check. Empty array means all is checked.
     */
    public static function notCheckedYet(string $hash): array;
}