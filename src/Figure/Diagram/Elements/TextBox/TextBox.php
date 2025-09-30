<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\TextBox;

use TextDraw\Common\Size;
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

    public function getScreen(): Screen
    {
        $size = $this->size;

        $this->addFigure(
            new Rectangle($this->leftUpperCorner, $size)
            ->setStyle($this->style->getRectangleStyle())
        );

        $start = $this->leftUpperCorner
            ->addX(intdiv($size->getWidth() - mb_strlen($this->text), 2))
            ->addY(intdiv($size->getHeight(), 2))

        ;

        $this->addFigure(new Text($start, $this->text));

        return parent::getScreen();
    }

    public function setStyle(TextBoxStyle $style): static
    {
        $this->style = $style;
        return $this;
    }
}
