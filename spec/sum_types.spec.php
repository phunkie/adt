<?php

use Phunkie\ADT\ImmutableSealed;
use Phunkie\ADT\SumType;
use Phunkie\ADT\TypeConstructor;

describe ("Sum types", function() {
    abstract class Weekday extends ImmutableSealed implements TypeConstructor {
        const sealedTo = [ Sunday::class, Monday::class, Tuesday::class,
            Wednesday::class, Thursday::class, Friday::class, Saturday::class];
    }
    final class Sunday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    final class Monday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    final class Tuesday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    final class Wednesday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    final class Thursday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    final class Friday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    final class Saturday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
    // and a bad boy
    final class Plutoday extends Weekday { use SumType; const typeConstructor = Weekday::class; }

    context("Offers a way to create types", function(){
        it("lets sum types pass as a Weekday", function() {
            $sunday = Sunday::new();
            expect((function(Weekday $weekday){ return $weekday; })($sunday))->toEqual(Sunday::new());
        });
    });
    context("Offers a way to seal classes", function(){
        it("complains when attempting to construct a sum type object outside seal", function() {
            expect(function(){ Plutoday::new(); })
                ->toThrow(new TypeError("Weekday is sealed and cannot be extended outside seal."));
        });
    });
});