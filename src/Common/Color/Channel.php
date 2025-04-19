<?php

declare(strict_types=1);

namespace ConsoleDraw\Common\Color;

use Exception;

class Channel
{
    /**
     * @var int<0, 255>
     */
    private int $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    /**
     * @return int<0, 255>
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): static
    {
        if ($value < 0 || $value > 255) {
            throw new Exception('incorrect color value');
        }
        $this->value = $value;
        return $this;
    }




}
