<?php

namespace ConsoleDraw\Figure;

class Pixel implements FigureInterface
{
    public function __construct(
        private int    $x,
        private int    $y,
        private string $symbol,
    ) {
    }

    public function draw(): array
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

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }


}
