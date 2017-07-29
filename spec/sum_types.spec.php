<?php

use Phunkie\ADT\ImmutableSealed;
use Phunkie\ADT\SumType;
use Phunkie\ADT\TypeConstructor;

describe ("Sum types", function() {

    abstract class Weekday implements TypeConstructor { use ImmutableSealed;
        const sealedTo = [ Sunday::class, Monday::class, Tuesday::class,
            Wednesday::class, Thursday::class, Friday::class, Saturday::class];
    }
    class Sunday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    class Monday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    class Tuesday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    class Wednesday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    class Thursday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    class Friday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    class Saturday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    // and a bad boy
    class Plutoday extends Weekday { use SumType; const typeConstructor = Weekday::class; }

    it("lets sum types pass as a Weekday", function() {
        $sunday = Sunday::new();
        expect((function(Weekday $weekday){ return $weekday; })($sunday))->toEqual(Sunday::new());
    });

    it("complains when attempting to construct a sum type object outside seal", function() {
        expect(function(){ Plutoday::new(); })
            ->toThrow(new TypeError("Weekday is sealed and cannot be extended outside seal."));
    });
});