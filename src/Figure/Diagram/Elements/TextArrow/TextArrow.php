<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\TextArrow;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Arrow\Arrow;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;

class TextArrow extends BaseFigure
{
    public function __construct(
        private string $text,
        private Point $start,
        private Point $end,
    ) {
        parent::__construct();
    }
    public function draw(): PixelMatrix
    {
        $arrow = new Arrow($this->start, $this->end);
        $this->addFigure(
            $arrow
        )->addFigure(
            new Text(
                $arrow->getLine()->getCenter()
                    ->subY(1)
                    ->subX(
                        intdiv(mb_strlen($this->text), 2)
                    ),
                $this->text
            )
        );


        return parent::draw();
    }

}
