<?php

declare(strict_types=1);

namespace TextDraw\Figure\Base;

use TextDraw\Screen\Screen;

class BaseFigure implements FigureInterface
{
    protected Screen $screen;


    public function __construct()
    {
        $this->screen = new Screen();
    }


    public function draw(): Screen
    {
        return $this->screen;
    }

    protected function addFigure(FigureInterface $figure): static
    {
        $this->screen->addFigure($figure);
        return $this;
    }


}
