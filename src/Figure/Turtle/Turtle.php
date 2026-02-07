<?php

declare(strict_types=1);

namespace TextDraw\Figure\Turtle;

use TextDraw\Figure\Base\FigureDrawerInterface;
use TextDraw\Plane\Point;
use TextDraw\Screen\Pixel\Pixel;
use TextDraw\Screen\Screen;

class Turtle implements FigureDrawerInterface
{
    private Point $position;
    private Screen $screen;

    public function __construct(
        ?Point $position = null,
    ) {
        $this->position = is_null($position) ? new Point(0, 0) : $position;
    }

    public function draw(): Screen
    {
        return $this->screen;
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

    public function paint(string $char): static
    {
        $this->screen = $this->screen->addFigure(new Pixel($this->position, $char));
        return $this;
    }

    public function paintRight(string $char, int $value = 1): static
    {
        for ($i = 0; $i < $value; $i++) {
            $this->screen = $this->screen->addFigure(new Pixel($this->position, $char));
            $this->moveRight();
        }

        return $this;
    }

    public function paintLeft(string $char, int $value = 1): static
    {
        for ($i = 0; $i < $value; $i++) {
            $this->screen = $this->screen->addFigure(new Pixel($this->position, $char));
            $this->moveLeft();
        }

        return $this;
    }

    public function paintUp(string $char, int $value = 1): static
    {
        for ($i = 0; $i < $value; $i++) {
            $this->screen = $this->screen->addFigure(new Pixel($this->position, $char));
            $this->moveUp();
        }

        return $this;
    }

    public function paintDown(string $char, int $value = 1): static
    {
        for ($i = 0; $i < $value; $i++) {
            $this->screen = $this->screen->addFigure(new Pixel($this->position, $char));
            $this->moveDown();
        }

        return $this;
    }

    public function getPosition(): Point
    {
        return $this->position;
    }

}
