<?php

declare(strict_types=1);

namespace TextDraw\Screen;

use TextDraw\Figure\Base\FigureInterface;

class ScreenBuilder
{
    private Screen $screen;

    private ?FigureInterface $currentFigure = null;

    public function __construct()
    {
        $this->screen = new Screen();
    }

    public function build(): Screen
    {
        if (!is_null($this->currentFigure)) {

            $this->screen->addFigure($this->currentFigure);
        }

        $this->currentFigure = null;
        return $this->screen;
    }


    public function addFigure(FigureInterface $figure): self
    {
        if (!is_null($this->currentFigure)) {
            $this->screen->addFigure($this->currentFigure);
        }

        $this->currentFigure = $figure;
        return $this;
    }

    public function move(int $deltaX, int $deltaY): self
    {
        $this->currentFigure->draw()->move($deltaX, $deltaY);
        return $this;
    }

    public function rotate(): self
    {
        foreach ($this->currentFigure->draw()->getPixels() as $pixel) {
            dump($pixel->getPoint()->getX() . ',' . $pixel->getPoint()->getY() . '=' . $pixel->getChar());
        }
        dump('-----------------------------------');
        $this->currentFigure->draw()->rotate();
        foreach ($this->currentFigure->draw()->getPixels() as $pixel) {
            dump($pixel->getPoint()->getX() . ',' . $pixel->getPoint()->getY() . '=' . $pixel->getChar());
        }
        return $this;
    }

}
