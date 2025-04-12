<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Circle;

class CircleStyle
{
    private string $char = '*';

    public function getChar(): string
    {
        return $this->char;
    }

    public function setChar(string $char): CircleStyle
    {
        $this->char = $char;
        return $this;
    }



}
