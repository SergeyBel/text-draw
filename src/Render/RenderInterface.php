<?php

declare(strict_types=1);

namespace ConsoleDraw\Render;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Plane\Size;

interface RenderInterface
{
    public function addFigure(FigureInterface $figure): static;

    public function getSize(): Size;
}
