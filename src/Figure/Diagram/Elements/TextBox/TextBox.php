<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\TextBox;

use TextDraw\Common\Size;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Rechtangle\Rectangle;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\Diagram\Elements\TextBox\TextBoxStyle;

class TextBox extends BaseFigure
{
    private TextBoxStyle $style;

    public function __construct(
        private string $text,
        private Point $leftUpperCorner,
    ) {
        $this->style = new TextBoxStyle();
        parent::__construct();
    }

    public function draw(): PixelMatrix
    {
        $size = $this->getSize();

        $this->addFigure(
            (new Rectangle($this->leftUpperCorner, $size))
            ->setStyle($this->style->getRectangleStyle())
        );

        $start = $this->leftUpperCorner
            ->addX(intdiv($size->getWidth() - mb_strlen($this->text), 2))
            ->addY(intdiv($size->getHeight(), 2))

        ;

        $this->addFigure(new Text($start, $this->text));

        return parent::draw();
    }

    public function getStyle(): TextBoxStyle
    {
        return $this->style;
    }

    public function setStyle(TextBoxStyle $style): static
    {
        $this->style = $style;
        return $this;
    }

    public function getSize(): Size
    {
        return new Size(
            mb_strlen($this->text) + $this->style->getLeftIndentation() + $this->style->getRightIndentation() + 2,
            $this->style->getTopIndentation() + $this->style->getBottomIndentation() + 3
        );
    }



}
