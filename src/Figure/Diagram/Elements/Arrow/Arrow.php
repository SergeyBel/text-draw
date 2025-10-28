<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\Arrow;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Text\Text;
use TextDraw\Figure\Text\TextStyle;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Arrow extends BaseFigure
{
    private ArrowStyle $style;

    public function __construct(
        private Point $start,
        private Point $end,
        private ?string $text = null
    ) {
        $this->style = new ArrowStyle();

        parent::__construct();
    }

    public function getScreen(): Screen
    {

        $middlePoint = new Point($this->start->getX(), $this->end->getY());

        $verticalLine = new Line($this->start, $middlePoint)
                                ->setStyle(
                                    new LineStyle()->setChar($this->style->getVerticalChar())
                                );

        $horizontalLine = new Line($middlePoint, $this->end);
        $horizontalStyle = new LineStyle()
                            ->setChar($this->style->getHorizontalChar());

        $textStart = null;
        if ($middlePoint->getX() < $this->end->getX()) {
            $horizontalStyle->setFinishChar('>');
            $textStart = clone $middlePoint;
        } elseif ($middlePoint->getX() > $this->end->getX()) {
            $horizontalStyle->setFinishChar('<');
            $textStart = clone $this->end;
        } elseif ($this->start->getY() < $this->end->getY()) {
            $horizontalStyle->setFinishChar('v');
        } else {
            $horizontalStyle->setFinishChar('^');
        }


        $horizontalLine->setStyle($horizontalStyle);

        $this
            ->addFigure($verticalLine)
            ->addFigure($horizontalLine)
        ;

        if (!is_null($this->text) && !is_null($textStart)) {
            $width = abs($middlePoint->getX() - $this->end->getX()) + 1;
            $this->addFigure(
                new Text($textStart->subY(1), $this->text, $width)
                    ->setStyle(new TextStyle()->setAlign($this->style->getAlign()))
            );
        }

        return parent::getScreen();
    }

    public function setStyle(ArrowStyle $style): self
    {
        $this->style = $style;
        return $this;
    }
}
