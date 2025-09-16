<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\Arrow;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Plane\Point;
use TextDraw\Plane\StraightLine;
use TextDraw\Screen\Screen;

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

    public function getScreen(): Screen
    {
        $line = new Line($this->start, $this->end);

        if ($this->line->isHorizontal()) {
            $style = new LineStyle()->setChar('-');

            if ($this->start->getX() < $this->end->getX()) {
                $style->setFinishChar('>');
            } else {
                $style->setStartChar('<');
            }
            $line->setStyle($style);
        } else {
            $style = new LineStyle()->setChar('|');

            if ($this->start->getY() < $this->end->getY()) {
                $style->setFinishChar('v');
            } else {
                $style->setStartChar('^');
            }

            $line->setStyle($style);
        }

        $this
            ->addFigure($line);

        return parent::getScreen();
    }

    public function getLine(): StraightLine
    {
        return $this->line;
    }
}
