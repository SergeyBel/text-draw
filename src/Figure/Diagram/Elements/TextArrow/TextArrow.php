<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\TextArrow;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Diagram\Elements\Arrow\Arrow;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class TextArrow extends BaseFigure
{
    private TextArrowStyle $style;

    public function __construct(
        private string $text,
        private Point $start,
        private Point $end,
    ) {
        $this->style = new TextArrowStyle();

        parent::__construct();
    }
    public function getScreen(): Screen
    {
        $arrow = new Arrow($this->start, $this->end);
        $this
                ->addFigure($arrow)
                ->addFigure(
                    new Text(
                        $arrow->getLine()->getCenter()
                    ->subY(1)
                    ->subX(
                        intdiv(mb_strlen($this->text), 2)
                    ),
                        $this->text
                    )
                );


        return parent::getScreen();
    }

    public function setStyle(TextArrowStyle $style): self
    {
        $this->style = $style;
        return $this;
    }



}
