<?php

declare(strict_types=1);

namespace TextDraw\Screen;

use TextDraw\Figure\Base\FigureInterface;

class Screen
{
    /**
     * @var array<FigureInterface>
     */
    private array $figures = [];

    private PixelMatrix $pixelMatrix;

    public function __construct()
    {
        $this->pixelMatrix = new PixelMatrix();
    }


    public function addFigure(FigureInterface $figure): self
    {
        $this->figures[] = $figure;
        $this->pixelMatrix->merge($figure->draw());
        return $this;
    }

    public function getPixels()
    {
        return $this->pixelMatrix->getPixels();
    }

    public function getSize()
    {
        return $this->pixelMatrix->getSize();
    }



    public function getMatrix(): PixelMatrix
    {
        return $this->pixelMatrix;
    }
}
