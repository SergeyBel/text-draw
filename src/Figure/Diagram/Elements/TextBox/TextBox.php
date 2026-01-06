<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\TextBox;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Common\Size;
use TextDraw\Common\VerticalAlign;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Rectangle\Rectangle;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class TextBox extends BaseFigure
{
    private TextBoxStyle $style;

    public function __construct(
        private string $text,
        private Point $leftUpperCorner,
        private Size $size,
    ) {
        $this->style = new TextBoxStyle();
        parent::__construct();
    }

    public function draw(): Screen
    {
        $size = $this->size;

        $this->addFigure(
            new Rectangle($this->leftUpperCorner, $size)
            ->setStyle($this->style->getRectangleStyle())
        );

        $start = $this->leftUpperCorner;

        switch ($this->style->getTextVerticalAlign()) {
            case VerticalAlign::Center:
                $start = $start->addY(intdiv($size->getHeight(), 2));
                break;
            case VerticalAlign::Bottom:
                $start = $start->addY($this->size->getHeight() - 2);
                break;
            case VerticalAlign::Top:
                $start = $start->addY(1);
                break;
        }

        switch ($this->style->getTextHorizontalAlign()) {
            case HorizontalAlign::Left:
                $start = $start->addX(1);
                break;
            case HorizontalAlign::Center:
                $start = $start->addX(intdiv($size->getWidth() - mb_strlen($this->text), 2));
                break;
            case HorizontalAlign::Right:
                $start = $start->addWidth($size->getWidth() - mb_strlen($this->text));
                break;
        }


        $this->addFigure(
            new Text($start, $this->text)
        );

        return parent::draw();
    }

    public function setStyle(TextBoxStyle $style): static
    {
        $this->style = $style;
        return $this;
    }

    public function getLeftUpperCorner(): Point
    {
        return $this->leftUpperCorner;
    }

    public function getLeftBottomCorner(): Point
    {
        return $this->leftUpperCorner->addHeight($this->size->getHeight());
    }

    public function getRightUpperCorner(): Point
    {
        return $this->getLeftUpperCorner()->addWidth($this->size->getWidth());
    }

    public function getRightBottomCorner(): Point
    {
        return $this->getLeftBottomCorner()->addWidth($this->size->getWidth());
    }

    public function getUpperCenter(): Point
    {
        return new Point(
            intdiv($this->getLeftUpperCorner()->getX() + $this->getRightUpperCorner()->getX(), 2),
            $this->getLeftUpperCorner()->getY(),
        );
    }

    public function getBottomCenter(): Point
    {
        return new Point(
            intdiv($this->getLeftBottomCorner()->getX() + $this->getRightBottomCorner()->getX(), 2),
            $this->getLeftBottomCorner()->getY(),
        );
    }

    public function getLeftCenter(): Point
    {
        return new Point(
            $this->getLeftBottomCorner()->getX(),
            intdiv($this->getLeftUpperCorner()->getY() + $this->getLeftBottomCorner()->getY(), 2),
        );
    }

    public function getRightCenter(): Point
    {
        return new Point(
            $this->getRightBottomCorner()->getX(),
            intdiv($this->getRightUpperCorner()->getY() + $this->getRightBottomCorner()->getY(), 2),
        );
    }

    public function getSize(): Size
    {
        return $this->size;
    }
}
