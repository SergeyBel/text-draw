<?php

declare(strict_types=1);

namespace TextDraw\Common;

class Char
{
    private string $char;

    public function __construct(string $char)
    {
        if (mb_strlen($char) !== 1) {
            throw new Exception\RenderException('Char string lenfth more than 1');
        }
        $this->char = $char;
    }

    public function getChar(): string
    {
        return $this->char;
    }
}
