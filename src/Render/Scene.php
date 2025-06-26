<?php

declare(strict_types=1);

namespace TextDraw\Render;

use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Figure\Pixel\PixelMatrix;

class Scene
{
    /**
     * @var array <FigureInterface>
     */
    private array $figures = [];


    public function addFigure(FigureInterface $figure): self
    {

        $this->figures[] = $figure;


        return $this;
    }

    public function getMatrix(): PixelMatrix
    {
        $pixelMatrix = new PixelMatrix();
        foreach ($this->figures as $figure) {
            $pixelMatrix->merge($figure->draw());
        }
        return $pixelMatrix;
    }


}
