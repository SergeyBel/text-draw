<?php

namespace ConsoleDraw;

class BaseFigure implements FigureInterface
{
    protected array $pixels = [];

    public function getPixels(): array
    {
        return $this->pixels;
    }

    protected function addFigure(FigureInterface $figure): self
    {
        $this->pixels = array_merge($this->pixels, $figure->getPixels());
        return $this;
    }


}
