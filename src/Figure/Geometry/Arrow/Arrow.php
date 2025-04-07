<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Arrow;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Plane\Point;
use Exception;

class Arrow extends BaseFigure
{
    private bool $horizontal;
    public function __construct(
        private Point $start,
        private Point $end,
    ) {
        if ($start->getY() === $end->getY()) {
            $this->horizontal = true;
        } elseif ($start->getX() === $end->getX()) {
            $this->horizontal = false;
        } else {
            throw new Exception('Arrow must be straight');
        }
    }

    public function draw(): array
    {
        $line = new Line($this->start, $this->end);

        if ($this->horizontal) {
            $style = (new LineStyle())->setSymbol('-');

            if ($this->start->getX() < $this->end->getX()) {
                $style->setFinishSymbol('>');
            } else {
                $style->setStartSymbol('<');
            }
            $line->setStyle($style);
        } else {
            $style = (new LineStyle())->setSymbol('|');

            if ($this->start->getY() < $this->end->getY()) {
                $style->setFinishSymbol('v');
            } else {
                $style->setStartSymbol('^');
            }

            $line->setStyle($style);
        }

        $this
            ->addFigure($line);

        return $this->pixels;
    }


}
