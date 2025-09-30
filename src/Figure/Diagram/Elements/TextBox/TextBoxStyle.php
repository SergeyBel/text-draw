<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\TextBox;

use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;
use TextDraw\Common\HorizontalAlign;
use TextDraw\Common\VerticalAlign;

class TextBoxStyle
{
    private RectangleStyle $rectangleStyle;

    private HorizontalAlign $textHorizontalAlign = HorizontalAlign::Center;

    private VerticalAlign $textVerticalAlign = VerticalAlign::Center;


    public function __construct()
    {
        $this->rectangleStyle =
            new RectangleStyle()
                ->setHorizontalChar('-')
                ->setVerticalChar('|')
                ->setCrossingChar('+')
        ;
    }

    public function getRectangleStyle(): RectangleStyle
    {
        return $this->rectangleStyle;
    }

    public function setRectangleStyle(RectangleStyle $rectangleStyle): self
    {
        $this->rectangleStyle = $rectangleStyle;
        return $this;
    }

    public function getTextHorizontalAlign(): HorizontalAlign
    {
        return $this->textHorizontalAlign;
    }

    public function getTextVerticalAlign(): VerticalAlign
    {
        return $this->textVerticalAlign;
    }

    public function setTextHorizontalAlign(HorizontalAlign $textHorizontalAlign): void
    {
        $this->textHorizontalAlign = $textHorizontalAlign;
    }

    public function setTextVerticalAlign(VerticalAlign $textVerticalAlign): self
    {
        $this->textVerticalAlign = $textVerticalAlign;
        return $this;
    }




}
