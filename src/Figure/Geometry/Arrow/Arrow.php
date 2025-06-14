<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Arrow;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Plane\Point;
use TextDraw\Plane\StraightLine;

class Arrow extends BaseFigure
{
    private StraightLine $line;

    public function __construct(
        private Point $start,
        private Point $end,
    ) {
        $this->line = new StraightLine($start, $end);

        parent::__construct();
    }

    public function draw(): PixelMatrix
    {
        $line = new Line($this->start, $this->end);

        if ($this->line->isHorizontal()) {
            $style = (new LineStyle())->setSymbol('-');

            if ($this->start->getX() < $this->end->getX()) {
                $style->setFinishChar('>');
            } else {
                $style->setStartChar('<');
            }
            $line->setStyle($style);
        } else {
            $style = (new LineStyle())->setSymbol('|');

            if ($this->start->getY() < $this->end->getY()) {
                $style->setFinishChar('v');
            } else {
                $style->setStartChar('^');
            }

            $line->setStyle($style);
        }

        $this
            ->addFigure($line);

        return parent::draw();
    }

    public function getLine(): StraightLine
    {
        return $this->line;
    }




}
