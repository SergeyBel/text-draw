<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Common\TextFrame;
use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Plane\Point;

class Text implements FigureInterface
{
    private TextStyle $style;
    private TextFrame $textFrame;

    public function __construct(
        private Point $start,
        string $text,
    ) {
        $this->style = new TextStyle();
        $this->textFrame = new TextFrame($text);
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

    public function draw(): PixelMatrix
    {
        $pixels = new PixelMatrix();
        $start = clone $this->start;

        $chars = mb_str_split($this->textFrame->getText());

        foreach ($chars as $char) {
            $pixels->setPixel(new Pixel($start, $char));
            $start = $start->addX(1);
        }

        return $pixels;
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
