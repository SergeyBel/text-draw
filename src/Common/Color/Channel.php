<?php

declare(strict_types=1);

namespace TextDraw\Common\Color;

use Exception;

class Channel
{
    /**
     * @var int<0, 255>
     */
    private int $value;

    public function __construct(int $value)
    {

        if ($value < 0 || $value > 255) {
            throw new Exception('incorrect color value');
        }

        $this->value = $value;
    }

    /**
     * @return int<0, 255>
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
