<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Common\Size;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Geometry\Rectangle\Rectangle;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class BarChartDrawer
{
    private Screen $screen;

    public function __construct()
    {
        $this->screen = new Screen();
    }

    /**
     * @param array<DatasetStyle> $datasetsStyles
     */
    public function draw(
        BarChartData $barChart,
        array $datasetsStyles,
        BarChartStyle $style
    ): Screen {
        $size = $barChart->getSize();
        $this->drawAxes($size);

        $start = new Point(0, 0)
            ->addHeight($barChart->getSize()->getHeight())
            ->addX(1)
        ;

        foreach ($barChart->getGroups() as $group) {
            $this->drawGroup($start, $group, $datasetsStyles);
            $start = $start->addX($group->getWidth() + $style->getGap());
        }

        return $this->screen;
    }

    private function drawAxes(size $size): void
    {
        $this->screen = $this->screen->addFigure(
            new Line(
                new Point(0, 0),
                new Point(0, 0)->addHeight($size->getHeight()),
            )->setStyle(new LineStyle()->setChar('|'))
        )
        ;
    }

    /**
     * @param array<DatasetStyle> $datasetsStyles
     */
    private function drawGroup(Point $groupStart, BarGroup $group, array $datasetsStyles): void
    {
        $start = clone $groupStart;
        $label = new Text($start, $group->getLabel(), $group->getWidth(), HorizontalAlign::Center);
        $this->screen = $this->screen->addFigure($label);


        foreach ($group->getBars() as $index => $bar) {
            $this->drawBar($start, $bar, $datasetsStyles[$index]);
            $start = $start->addX($bar->getSize()->getWidth());
        }

    }

    private function drawBar(Point $start, Bar $bar, DatasetStyle $style): void
    {
        $this->screen = $this->screen->addFigure(
            new Rectangle(
                $start->subY($bar->getSize()->getHeight()),
                $bar->getSize(),
            )->setStyle($style->getBarStyle())
        );
    }

}
