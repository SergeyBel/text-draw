<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\TextBox;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Common\VerticalAlign;
use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;

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

    public function setTextHorizontalAlign(HorizontalAlign $textHorizontalAlign): self
    {
        $this->textHorizontalAlign = $textHorizontalAlign;
        return $this;
    }

    public function setTextVerticalAlign(VerticalAlign $textVerticalAlign): self
    {
        $this->textVerticalAlign = $textVerticalAlign;
        return $this;
    }




}
