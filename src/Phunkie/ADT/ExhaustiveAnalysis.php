<?php

namespace Phunkie\ADT;

trait ExhaustiveAnalysis
{
    public static function notCheckedYet(string $hash): array
    {
        return array_values(array_filter(static::sealedTo, function($sumType) use ($hash) {
            return !call_user_func_array([$sumType, 'isChecked'], [$hash]);
        }));
    }
}