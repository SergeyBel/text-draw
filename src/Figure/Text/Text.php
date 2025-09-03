<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Common\TextFrame;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Text extends BaseFigure
{
    private TextStyle $style;
    private TextFrame $textFrame;

    public function __construct(
        private Point $start,
        string $text,
    ) {
        $this->style = new TextStyle();
        $this->textFrame = new TextFrame($text);
        parent::__construct();
    }

    public static function fromTextFrame(Point $start, TextFrame $textFrame): Text
    {
        $text = new self($start, $textFrame->getText());
        $text->setStyle(
            new TextStyle()
                ->setWidth($textFrame->getWidth())
                ->setPaddingChar($textFrame->getPaddingChar())
                ->setAlign($textFrame->getAlign())
        );
        return $text;
    }

    public function draw(): Screen
    {
        $screen = new Screen();
        $start = clone $this->start;

        $chars = mb_str_split($this->textFrame->getText());

        foreach ($chars as $char) {
            $screen->setPixel(new Pixel($start, $char));
            $start = $start->addX(1);
        }

        return $screen;
    }

    public function getStyle(): TextStyle
    {
        return $this->style;
    }

    public function setStyle(TextStyle $style): static
    {
        $this->style = $style;
        $this->textFrame
            ->setWidth($style->getWidth())
            ->setAlign($style->getAlign())
            ->setPaddingChar($style->getPaddingChar());
        return $this;
    }
}
