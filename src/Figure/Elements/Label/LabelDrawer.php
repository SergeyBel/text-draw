<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Label;

use TextDraw\Screen\Pixel\Pixel;
use TextDraw\Screen\Screen;

class LabelDrawer
{
    public function draw(Label $label): Screen
    {
        $screen = new Screen();

        foreach ($label->getLines() as $index => $line) {
            $point = $label->getStart()->addY($index);
            foreach (mb_str_split($line) as $char) {
                $screen = $screen->setPixel(new Pixel($point, $char));
                $point = $point->addX(1);
            }
        }

        return $screen;

    }

}
