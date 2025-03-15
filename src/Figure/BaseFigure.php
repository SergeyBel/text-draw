<?php

namespace ConsoleDraw\Figure;

class BaseFigure implements FigureInterface
{
    /**
     * @var array<Pixel>
     */
    protected array $pixels = [];

    public function draw(): array
    {
        return $this->pixels;
    }

    protected function addFigure(FigureInterface $figure): self
    {
        $this->pixels = array_merge($this->pixels, $figure->draw());
        return $this;
    }


}
