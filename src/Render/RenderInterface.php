<?php

declare(strict_types=1);

namespace ConsoleDraw\Render;

use ConsoleDraw\Figure\Base\FigureInterface;

interface RenderInterface
{
    public function addFigure(FigureInterface $figure): static;
}
