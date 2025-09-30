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

    private ArrowStyle $style;

    public function __construct(
        private Point $start,
        private Point $end,
    ) {
        $this->line = new StraightLine($start, $end);
        $this->style = new ArrowStyle();

        parent::__construct();
    }

    public function getScreen(): Screen
    {
        $line = new Line($this->start, $this->end);

        if ($this->line->isHorizontal()) {
            $char = $this->style->getChar() ?? '-';
            $style = new LineStyle()->setChar($char);

            if ($this->start->getX() < $this->end->getX()) {
                $style->setFinishChar('>');
            } else {
                $style->setFinishChar('<');
            }
            $line->setStyle($style);
        } else {
            $char = $this->style->getChar() ?? '|';
            $style = new LineStyle()->setChar($char);

            if ($this->start->getY() < $this->end->getY()) {
                $style->setFinishChar('v');
            } else {
                $style->setFinishChar('^');
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

    public function setStyle(ArrowStyle $style): self
    {
        $this->style = $style;
        return $this;
    }
}
