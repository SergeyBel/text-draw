<?php

declare(strict_types=1);

namespace ConsoleDraw\Common;

use InvalidArgumentException;

class PositiveInt
{
    /**
     * @var int<1, max>
     */
    private int $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    /**
     * @return int<1, max>
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        if ($value < 1) {
            throw new InvalidArgumentException('Value must be positive');
        }
        $this->value = $value;
        return $this;
    }

    public function add(int $value): static
    {
        $that = clone $this;
        $that->setValue($that->value + $value);
        return $that;
    }

    public function sub(int $value): static
    {
        $that = clone $this;
        $that->setValue($that->value - $value);
        return $that;
    }

}
