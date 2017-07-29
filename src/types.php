<?php

namespace Phunkie\Types {
    const Int = "Int";
    const Double = "Double";
    const Float = "Float";
    const Bool = "Bool";
    const String = 'String';
    const Resource = 'Resource';
    const Object = 'Object';
    const Vector = 'Array';
    const Mixed = 'Mixed';
    const Pair = 'Pair';
    const Tuple = 'Tuple';
    const Unit = 'Unit';
    const Void = 'Void';
    const ImmList = 'ImmList';
    const ImmSet = 'ImmSet';
    const ImmMap = 'ImmMap';
    const Nil = 'Nil';
    const Nel = 'Nel';
    const Cons = 'Cons';
    const Option = 'Option';
    const Some = 'Some';
    const None = 'None';
    const Nothing = 'Nothing';

    // for generics
    const A = "A";
    const B = "B";
    const C = "C";
    const D = "D";
    const E = "E";
    const F = "F";
    const G = "G";
    const H = "H";
    const I = "I";
    const J = "J";
    const K = "K";
    const L = "L";
    const M = "M";
    const N = "N";
    const O = "O";
    const P = "P";
    const Q = "Q";
    const R = "R";
    const S = "S";
    const T = "T";
    const U = "U";
    const V = "V";
    const W = "W";
    const Y = "Y";
    const X = "X";
    const Z = "Z";

    function is_generic(string $type)
    {
        return in_array($type, range(A, Z), true);
    }
}