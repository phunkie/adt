Phunkie ADTs: Algebraic Data Types for PHP
==========================================

"In computer programming, especially functional programming and type theory, an algebraic data type is a kind of
composite type, i.e., a type formed by combining other types." — good old Wikipedia

Sum Types
---------

In computer science sum type, is a data structure used to hold a value that could take on several different, but fixed,
types. Only one of the types can be in use at any one time, and a tag field explicitly indicates which one is in use.

Let's say we want to create a type Weekday. We want it to be limited to the possible 7 days in the week: Sunday, Monday,
Tuesday, Wednesday, Thursday, Friday and Saturday.

We could do that in a number of ways using typical imperative or Object Oriented techniques. We could use enums,
constants grouped under an interface or inheritance.

At the moment PHP does not have enums, so that one is not a choice.

Grouping constants in a interface is a popular alternative, but it does not give any type safety.

```php
<?php
interface WeekDay {
    const SUNDAY = 'Sunday',
          MONDAY = 'Monday',
          TUESDAY = 'Tuesday',
          WEDNESDAY = 'Wednesday',
          THURSDAY = 'Thursday',
          FRIDAY = 'Friday',
          SATURDAY = 'Saturday';
}
```

When passing a weekday to a function I cannot specify the Weekday type as a type hint. 

Finally we could try extending a super class or implementing a common interface.

```php
<?php
interface Weekday {}
final class Sunday implements Weekday { }
final class Monday implements Weekday { }
//...
```

Now we can type hint Weekday we passing it around:

```php
<?php
function orderPizza(Weekday $weekday, Pizza $pizza)
{
    switch (get_class($weekday)) {
        case Wednesday::class : return new WednesdayPromotionOrder($pizza);
        default : return new Order($pizza);
    }
}
```

There is, however, no way in PHP to guarantee that the interface won't be extended beyond the ones distributed with the
library. Nothing stops a Pluto fan from:

```php
<?php
final class Plutoday implements Weekday { }
```

And all of a sudden we can now order pizza in weird days. But fear not! Sum types is there to save us from that madness.

First we create a type constructor `Weekday`. PHP only way to create hintable types is through classes. So, let's use
that.

```php
<?php
abstract class Weekday implements TypeConstructor { use SumType; }
```

Then we seal it. Let's use `ImmutableSealed` to add immutablity while we are at
it

```php
<?php
abstract class Weekday extends ImmutableSealed implements TypeConstructor { use SumType; }
```

`ImmutableSealed` requires us to tell what is the types the type constructor can create

```php
<?php
abstract class Weekday extends ImmutableSealed implements TypeConstructor {
    use SumType;
    const sealedTo = [Sunday::class, /*...*/ Saturday::class];
}
```

We still need to create the sum types:

```php
<?php
final class Sunday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
final class Monday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
//...
final class Saturday extends Weekday { use SumType; const typeConstructor = Weekday::class; }
```

If we try to extend `Weekday` outside the seal we get a type error.

```php
<?php
final class Plotoday extends Weekday { use SumType; const typeConstructor = Weekday::class; }

new Plutoday; // results in:
              // TypeError has been thrown with message: "Weekday is sealed and cannot be extended outside seal."
```

TODO:
-----
 - Sum types to provide a mechanism for Pattern Matching to know the cases have all been exhausted in a match.
 - Generics/Kinds: First order, higher order
 - Implementing Show, Eq, Ord

Final Notes
-----------
 - Phunkie is alpha software and may not be used in production