<?php

declare(strict_types=1);

namespace TextDraw\Tests;

use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\ExpectationFailedException;
use SebastianBergmann\Comparator\ComparisonFailure;

class RenderConstraint extends Constraint
{
    public function __construct(
        private string $expected
    ) {
    }

    protected function matches(mixed $other): bool
    {
        return $this->expected === $other;
    }


    public function toString(): string
    {
        return 'render constraint';
    }

    protected function fail(mixed $other, string $description, ?ComparisonFailure $comparisonFailure = null): never
    {
        throw new ExpectationFailedException(
            $description,
        );
    }


}
