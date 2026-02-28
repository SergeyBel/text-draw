<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\BarChart;

use TextDraw\Common\Size;
use TextDraw\Figure\Elements\Geometry\Rectangle\Rectangle;
use TextDraw\Figure\Elements\Geometry\Rectangle\RectangleDrawer;
use TextDraw\Figure\Elements\Label\Label;
use TextDraw\Figure\Elements\Label\LabelDrawer;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class BarChartDrawer
{
    public const BAR_WIDTH = 4;
    public const BAR_GAP = 1;
    public function draw(BarChart $barChart): Screen
    {
        $screen = new Screen();
        $labelDrawer = new LabelDrawer();
        $rectangleDrawer = new RectangleDrawer();

        $bottomY = $this->calculateBottomY($barChart);

        $start = new Point(0, $bottomY);
        foreach ($barChart->getBars() as $bar) {
            $screen = $screen->merge(
                $labelDrawer->draw(new Label($start, $bar->getLabel()))
            );
            $screen = $screen->merge(
                $rectangleDrawer->draw(
                    new Rectangle(
                        $start->subY($bar->getValue()),
                        new Size(self::BAR_WIDTH, $bar->getValue())
                    )
                )
            );

            $start = $start->addX(self::BAR_WIDTH + self::BAR_GAP);
        }
        return $screen;
    }

    private function calculateBottomY(BarChart $barChart): int
    {
        $max = 0;
        foreach ($barChart->getBars() as $bar) {
            $max = max($max, $bar->getValue());
        }
        return $max;
    }



}
