<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Geometry\Line;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Screen\Pixel\Pixel;
use TextDraw\Screen\Screen;

class LineDrawer
{
    public function draw(Line $line): Screen
    {
        if ($line->isHorizontal()) {
            $deltaX = 1;
            $deltaY = 0;
            $start = $line->getMinXPoint();
            $end = $line->getMaxXPoint();
            $char = '-';
        } elseif ($line->isVertical()) {
            $deltaX = 0;
            $deltaY = 1;
            $start = $line->getMinYPoint();
            $end = $line->getMaxYPoint();
            $char = '|';
        } elseif ($line->isDiagonal()) {
            $start = $line->getMinYPoint();
            $end = $line->getMaxYPoint();

            if ($start->getX() > $end->getX()) {
                $deltaX = -1;
                $deltaY = 1;
                $char = '/';
            } else {
                $deltaX = 1;
                $deltaY = 1;
                $char = '\\';
            }
        } else {
            throw new RenderException('Unknown line type');
        }


        $point = $start;
        $pixels = [];
        $drawn = true;

        while ($drawn) {
            if ($point->equals($end)) {
                $drawn = false;
            }

            $pixels[] = new Pixel($point, $char);
            $point = $point
                ->addX($deltaX)
                ->addY($deltaY);
        }


        return new Screen($pixels);
    }

}
