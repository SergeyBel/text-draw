<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\TextBox;

use TextDraw\Common\Size;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Rechtangle\Rectangle;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;

class TextBox extends BaseFigure
{
    public function __construct(
        private string $text,
        private Point $leftUpperCorner,
        private Size $size,
    ) {
        parent::__construct();
    }

    public function draw(): PixelMatrix
    {
        $this->addFigure(new Rectangle($this->leftUpperCorner, $this->size));

        $start = $this->leftUpperCorner
            ->addX(intdiv($this->size->getWidth() - mb_strlen($this->text), 2))
            ->addY(intdiv($this->size->getHeight(), 2))

        ;

        $this->addFigure(new Text($start, $this->text));

        return parent::draw();
    }

}
