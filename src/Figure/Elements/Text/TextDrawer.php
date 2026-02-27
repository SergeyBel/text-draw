<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Text;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Screen\Pixel\Pixel;
use TextDraw\Screen\Screen;

class TextDrawer
{
    private int $paddingBefore;
    private int $paddingAfter;

    public function draw(Text $text): Screen
    {
        $start = $text->getStart();
        $screen = new Screen();
        $this->calculatePadding($text);

        $start = $start->addX($this->paddingBefore);

        $chars = mb_str_split($text->getText());

        for ($i = 0; $i < $text->getWidth() - $this->paddingBefore - $this->paddingAfter; $i++) {
            $screen = $screen->setPixel(new Pixel($start, $chars[$i]));
            $start = $start->addX(1);
        }

        return $screen;
    }

    private function calculatePadding(Text $text): void
    {
        $width = $text->getWidth();
        $align = $text->getAlign();
        $text = $text->getText();

        $length = mb_strlen($text);
        if ($align === HorizontalAlign::Left) {
            $paddingBefore = 0;
            $paddingAfter = max(0, $width - $length);
        } elseif ($align === HorizontalAlign::Right) {
            $paddingBefore = max(0, $width - $length);
            $paddingAfter = 0;
        } elseif ($align === HorizontalAlign::Center) {
            $paddingAfter = max(0, intdiv($width, 2) - intdiv($length, 2));
            $paddingBefore = max(0, $width - $length - $paddingAfter);
        }

        $this->paddingBefore = $paddingBefore;
        $this->paddingAfter = $paddingAfter;

    }

}
