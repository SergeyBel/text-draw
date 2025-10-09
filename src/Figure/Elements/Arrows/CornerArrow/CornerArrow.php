<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Arrows\CornerArrow;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Elements\Arrows\Arrow\Arrow;
use TextDraw\Figure\Elements\Arrows\Arrow\ArrowStyle;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class CornerArrow extends BaseFigure
{
    private CornerArrowStyle $style;

    public function __construct(
        private Point $start,
        private Point $end,
    ) {
        $this->style = new CornerArrowStyle();
        parent::__construct();
    }

    public function getScreen(): Screen
    {
        $middlePoint = new Point($this->end->getX(), $this->start->getY());
        $this
            ->addFigure(
                new Arrow($middlePoint, $this->end)
                    ->setStyle(
                        new ArrowStyle()->setChar($this->style->getVerticalChar())
                    )
            )
            ->addFigure(
                new Line($this->start, $middlePoint)
                    ->setStyle(
                        new LineStyle()->setChar($this->style->getHorizontalChar())
                    )
            )

        ;

        return parent::getScreen();
    }

    public function setStyle(CornerArrowStyle $style): self
    {
        $this->style = $style;
        return $this;
    }



}
