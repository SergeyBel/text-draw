<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Triangle;

use TextDraw\Common\Char;

class TriangleStyle
{
    private Char $char;

    public function __construct()
    {
        $this->char = new Char('*');

    }

    public function getChar(): string
    {
        return $this->char->getChar();
    }

    public function setChar(string $char): static
    {
        $this->char = new Char($char);
        return $this;
    }


}
