<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Triangle;

class TriangleStyle
{
    private string $char = '*';

    public function getChar(): string
    {
        return $this->char;
    }

    public function setChar(string $char): static
    {
        $this->char = $char;
        return $this;
    }


}
