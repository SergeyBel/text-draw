<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Screen\Screen;

class TextDrawer
{
    public function draw(TextData $text, TextStyle $style): Screen
    {
        $start = $text->getStart();
        $screen = new Screen();

        for ($i = 0; $i < $text->getPaddingBefore(); $i++) {
            if (!is_null($style->getPaddingChar())) {
                $screen = $screen->addFigure(new Pixel($start, $style->getPaddingChar()));
            }

            $start = $start->addX(1);
        }

        $chars = mb_str_split($text->getText());

        for ($i = 0; $i < $text->getWidth() - $text->getPaddingBefore() - $text->getPaddingAfter(); $i++) {
            $screen = $screen->addFigure(new Pixel($start, $chars[$i]));
            $start = $start->addX(1);
        }

        for ($i = 0; $i < $text->getPaddingAfter(); $i++) {
            if (!is_null($style->getPaddingChar())) {
                $screen = $screen->addFigure(new Pixel($start, $style->getPaddingChar()));
            }

            $start = $start->addX(1);
        }

        return $screen;
    }

}
