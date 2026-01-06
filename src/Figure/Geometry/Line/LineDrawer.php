<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Line;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Screen\Screen;

class LineDrawer
{
    public function draw(LineData $line, LineStyle $style): Screen
    {
        if ($line->isHorizontal()) {
            $deltaX = 1;
            $deltaY = 0;
            $start = $line->getMinXPoint();
            $end = $line->getMaxXPoint();
        } elseif ($line->isVertical()) {
            $deltaX = 0;
            $deltaY = 1;
            $start = $line->getMinYPoint();
            $end = $line->getMaxYPoint();
        } elseif ($line->isDiagonal()) {
            $start = $line->getMinYPoint();
            $end = $line->getMaxYPoint();

            if ($start->getX() > $end->getX()) {
                $deltaX = -1;
                $deltaY = 1;
            } else {
                $deltaX = 1;
                $deltaY = 1;
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

            $pixels[] = new Pixel($point, $style->getChar());
            $point = $point
                ->addX($deltaX)
                ->addY($deltaY);
        }

        if (!is_null($style->getStartChar())) {
            $pixels[] = new Pixel($line->getStart(), $style->getStartChar());
        }

        if (!is_null($style->getEndChar())) {
            $pixels[] = new Pixel($line->getEnd(), $style->getEndChar());
        }


        return new Screen($pixels);
    }

}
