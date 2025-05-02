<?php

declare(strict_types=1);

namespace ConsoleDraw\Frame;

use ConsoleDraw\Figure\Base\FigureInterface;
use ConsoleDraw\Figure\Pixel\PixelMatrix;

class Frame
{
    /**
     * @var array<string, FigureInterface>
     */
    private array $namedFigures = [];

    /**
     * @var array <FigureInterface>
     */
    private array $figures = [];


    public function addFigure(FigureInterface $figure, ?string $name = null): self
    {
        if (!is_null($name)) {
            $this->namedFigures[$name] = $figure;
        } else {
            $this->figures[] = $figure;
        }

        return $this;
    }

    public function draw(): PixelMatrix
    {
        $allFigures = array_merge($this->figures, array_values($this->namedFigures));

        $pixelMatrix = new PixelMatrix();
        foreach ($allFigures as $figure) {
            $pixelMatrix->merge($figure->draw());
        }
        return $pixelMatrix;
    }


}
