<?php

declare(strict_types=1);

namespace TextDraw\Figure\Turtle;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Plane\Point;

class Turtle extends BaseFigure
{
    private Point $position;

    public function __construct()
    {
        $this->position = new Point(0, 0);
        parent::__construct();
    }

    public function moveRight(int $value = 1): static
    {
        $this->position = $this->position->addX($value);
        return $this;
    }
    public function moveLeft(int $value = 1): static
    {
        $this->position = $this->position->subX($value);
        return $this;
    }

    public function moveUp(int $value = 1): static
    {
        $this->position = $this->position->subY($value);
        return $this;
    }

    public function moveDown(int $value = 1): static
    {
        $this->position = $this->position->addY($value);
        return $this;
    }

    public function moveTo(Point $point): static
    {
        $this->position = $point;
        return $this;
    }

    public function paint(string $symbol): static
    {
        $this->addFigure(new Pixel($this->position, $symbol));
        return $this;
    }

    public function paintRight(string $symbol, int $value = 1): static
    {
        for ($i = 0; $i < $value; $i++) {
            $this
                ->addFigure(new Pixel($this->position, $symbol))
                ->moveRight();
        }

        return $this;
    }

    public function paintLeft(string $symbol, int $value = 1): static
    {
        for ($i = 0; $i < $value; $i++) {
            $this
                ->addFigure(new Pixel($this->position, $symbol))
                ->moveLeft();
        }

        return $this;
    }

    public function paintUp(string $symbol, int $value = 1): static
    {
        for ($i = 0; $i < $value; $i++) {
            $this
                ->addFigure(new Pixel($this->position, $symbol))
                ->moveUp();
        }

        return $this;
    }

    public function paintDown(string $symbol, int $value = 1): static
    {
        for ($i = 0; $i < $value; $i++) {
            $this
                ->addFigure(new Pixel($this->position, $symbol))
                ->moveDown();
        }

        return $this;
    }

    public function getPosition(): Point
    {
        return $this->position;
    }

}
