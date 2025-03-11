<?php

namespace ConsoleDraw;

class Point implements FigureInterface
{
    public function __construct(
        private int $x,
        private int $y,
        private string $char,
    ) {
    }

    public function getPoints(): array
    {
        return [$this];
    }


    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }

    public function getChar(): string
    {
        return $this->char;
    }

    public function setChar(string $char): void
    {
        $this->char = $char;
    }


}
