<?php

namespace ConsoleDraw\Figure\FunctionGraph;

class FunctionValue
{
    public function __construct(
        private int $x,
        private int $y,
    ) {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): FunctionValue
    {
        $this->x = $x;
        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): FunctionValue
    {
        $this->y = $y;
        return $this;
    }


}
