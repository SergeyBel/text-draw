<?php

declare(strict_types=1);

namespace TextDraw\Common;

use InvalidArgumentException;

class PositiveInt
{
    /**
     * @var int<1, max>
     */
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 1) {
            throw new InvalidArgumentException('Value must be positive');
        }
        $this->value = $value;
    }

    /**
     * @return int<1, max>
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function add(int $value): self
    {
        return new self($this->value + $value);
    }

    public function sub(int $value): self
    {
        return new self($this->value - $value);
    }

}
