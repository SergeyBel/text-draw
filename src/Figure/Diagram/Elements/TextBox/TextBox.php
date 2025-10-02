<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\TextBox;

use TextDraw\Common\Size;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Rectangle\Rectangle;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;
use TextDraw\Common\VerticalAlign;
use TextDraw\Common\HorizontalAlign;

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

    public function getScreen(): Screen
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

        return parent::getScreen();
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

    public function getSize(): Size
    {
        return $this->size;
    }


}
