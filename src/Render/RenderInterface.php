<?php

declare(strict_types=1);

namespace ConsoleDraw\Render;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\FigureInterface;

interface RenderInterface
{
    public function addFigure(FigureInterface $figure): static;

    public function getSize(): Size;
}
