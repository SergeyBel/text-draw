<?php

declare(strict_types=1);

namespace TextDraw\Screen;

use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Common\Exception\RenderException;

class ScreenBuilder
{
    private Screen $screen;

    private ?Screen $currentScreen = null;

    public function __construct()
    {
        $this->screen = new Screen();
    }

    public function build(): Screen
    {
        if (!is_null($this->currentScreen)) {

            $this->screen = $this->screen->merge($this->currentScreen);
        }

        $this->currentScreen = null;

        return $this->screen;
    }


    public function addFigure(FigureInterface $figure): self
    {
        if (!is_null($this->currentScreen)) {
            $this->screen = $this->screen->merge($this->currentScreen);
        }

        $this->currentScreen = $figure->draw();
        return $this;
    }

    public function move(int $deltaX, int $deltaY): self
    {
        if (is_null($this->currentScreen)) {
            throw new RenderException('No figure to move');
        }

        $this->currentScreen = $this->currentScreen->move($deltaX, $deltaY);
        return $this;
    }

    public function rotate(): self
    {
        if (is_null($this->currentScreen)) {
            throw new RenderException('No figure to rotate');
        }

        $this->currentScreen = $this->currentScreen->rotate();
        return $this;
    }

}
