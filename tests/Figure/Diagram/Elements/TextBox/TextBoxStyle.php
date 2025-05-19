<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagram\Elements\TextBox;

use TextDraw\Figure\Geometry\Rechtangle\RectangleStyle;

class TextBoxStyle
{
    private RectangleStyle $rectangleStyle;

    private int $leftIndentation = 1;
    private int $rightIndentation = 1;
    private int $topIndentation = 0;
    private int $bottomIndentation = 0;

    public function __construct()
    {
        $this->rectangleStyle =
            (new RectangleStyle())
                ->setHorizontalChar('-')
                ->setVerticalChar('|')
                ->setCrossingChar('+')
        ;
    }

    public function getRectangleStyle(): RectangleStyle
    {
        return $this->rectangleStyle;
    }

    public function setRectangleStyle(RectangleStyle $rectangleStyle): static
    {
        $this->rectangleStyle = $rectangleStyle;
        return $this;
    }

    public function getLeftIndentation(): int
    {
        return $this->leftIndentation;
    }

    public function setLeftIndentation(int $leftIndentation): static
    {
        $this->leftIndentation = $leftIndentation;
        return $this;
    }

    public function getRightIndentation(): int
    {
        return $this->rightIndentation;
    }

    public function setRightIndentation(int $rightIndentation): static
    {
        $this->rightIndentation = $rightIndentation;
        return $this;
    }

    public function getTopIndentation(): int
    {
        return $this->topIndentation;
    }

    public function setTopIndentation(int $topIndentation): static
    {
        $this->topIndentation = $topIndentation;
        return $this;
    }

    public function getBottomIndentation(): int
    {
        return $this->bottomIndentation;
    }

    public function setBottomIndentation(int $bottomIndentation): static
    {
        $this->bottomIndentation = $bottomIndentation;
        return $this;
    }
}
