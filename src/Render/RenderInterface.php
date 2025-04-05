<?php

declare(strict_types=1);

namespace ConsoleDraw\Render;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel;

interface RenderInterface
{
    public function setPixel(Pixel $pixel): static;
    /**
     * @param array<Pixel> $pixels
     */
    public function setPixels(array $pixels): static;

    public function addFigure(FigureInterface $figure): static;

}
