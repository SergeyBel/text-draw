<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\Arrow;

use TextDraw\Figure\Base\BaseFigureDrawer;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Text\Text;
use TextDraw\Figure\Text\TextStyle;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Arrow extends BaseFigureDrawer
{
    private ArrowStyle $style;

    public function __construct(
        private Point $start,
        private Point $end,
        private ArrowDirection $direction,
        private ?string $text = null,
    ) {
        $this->style = new ArrowStyle();

        parent::__construct();
    }

    public function draw(): Screen
    {
        $horizontalLine = null;
        $verticalLine = null;

        if ($this->direction === ArrowDirection::SIDE) {
            $middlePoint = new Point($this->start->getX(), $this->end->getY());

            $horizontalLine = new Line($middlePoint, $this->end);

            $horizontalStyle = new LineStyle()
                ->setChar($this->style->getHorizontalChar());

            if ($this->start->getX() < $this->end->getX()) {
                $horizontalStyle->setEndChar('>');
            } else {
                $horizontalStyle->setEndChar('<');
            }

            $horizontalLine->setStyle($horizontalStyle);

            if (!$middlePoint->equals($this->start)) {
                $verticalLine = new Line($this->start, $middlePoint)
                    ->setStyle(
                        new LineStyle()->setChar($this->style->getVerticalChar())
                    );
            }

        } else {

            $middlePoint = new Point($this->end->getX(), $this->start->getY());


            $verticalLine = new Line($middlePoint, $this->end);

            $verticalStyle = new LineStyle()
                ->setChar($this->style->getVerticalChar());

            if ($this->start->getY() < $this->end->getY()) {
                $verticalStyle->setEndChar('v');
            } else {
                $verticalStyle->setEndChar('^');
            }

            $verticalLine->setStyle($verticalStyle);

            if (!$middlePoint->equals($this->start)) {
                $horizontalLine = new Line($this->start, $middlePoint)
                    ->setStyle(
                        new LineStyle()->setChar($this->style->getHorizontalChar())
                    );
            }


        }

        if (!is_null($verticalLine)) {
            $this
                ->addFigure($verticalLine);
        }

        if (!is_null($horizontalLine)) {
            $this
                ->addFigure($horizontalLine);

            if (!is_null($this->text)) {
                $textStart = $horizontalLine->getStart();
                $textWidth = abs($horizontalLine->getStart()->getX() - $horizontalLine->getEnd()->getX()) + 1;
                $this->addFigure(
                    new Text($textStart->subY(1), $this->text, $textWidth)
                        ->setStyle(new TextStyle()->setAlign($this->style->getAlign()))
                );
            }
        }




        return parent::draw();
    }

    public function setStyle(ArrowStyle $style): self
    {
        $this->style = $style;
        return $this;
    }
}
