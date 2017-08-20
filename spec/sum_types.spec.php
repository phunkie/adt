<?php

use Phunkie\ADT\ExhaustiveAnalysis;
use Phunkie\ADT\ImmutableSealed;
use Phunkie\ADT\SumType;
use Phunkie\ADT\SumTypeTag;
use Phunkie\ADT\TypeConstructor;

describe ("Sum types", function() {
    abstract class Weekday extends ImmutableSealed implements TypeConstructor, SumTypeTag {
        use ExhaustiveAnalysis;
        const sealedTo = [ Sunday::class, Monday::class, Tuesday::class,
            Wednesday::class, Thursday::class, Friday::class, Saturday::class];
        public function __construct() { $this->applySeal(); }
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
            $sunday = new Sunday();
            expect((function(Weekday $weekday){ return $weekday; })($sunday))->toEqual(new Sunday());
        });
    });
    context("Offers a way to seal classes", function(){
        it("complains when attempting to construct a sum type object outside seal", function() {
            expect(function(){ new Plutoday(); })
                ->toThrow(new TypeError("Weekday is sealed and cannot be extended outside seal."));
        });
    });

    context("Offers a way to implement exhaustive analysis", function() {
        it("lets us mark a sum type as checked for a specific match", function() {
            $matchHash = md5(microtime());
            Sunday::markChecked($matchHash);
            expect(Sunday::isChecked($matchHash))->toBe(true);
        });

        it("passes exhaustive analysis when all cases were checked", function() {
            $hash = md5(microtime());
            Sunday::markChecked($hash);
            Monday::markChecked($hash);
            Tuesday::markChecked($hash);
            Wednesday::markChecked($hash);
            Thursday::markChecked($hash);
            Friday::markChecked($hash);
            Saturday::markChecked($hash);

            expect(Weekday::notCheckedYet($hash))->toBe([]);
        });

        it("does not pass exhaustive analysis when only some cases were checked", function() {
            $hash = md5(microtime());
            Sunday::markChecked($hash);
            Monday::markChecked($hash);
            Tuesday::markChecked($hash);
            Wednesday::markChecked($hash);

            expect(Weekday::notCheckedYet($hash))->toBe([Thursday::class, Friday::class, Saturday::class]);
        });
    });
});