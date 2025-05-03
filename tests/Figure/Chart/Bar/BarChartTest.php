<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Chart\Bar;

use ConsoleDraw\Figure\Chart\Bar\Bar;
use ConsoleDraw\Figure\Chart\Bar\BarChart;
use ConsoleDraw\Figure\Chart\Bar\BarChartStyle;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class BarChartTest extends FigureTestCase
{
    public function testBarChart(): void
    {
        $barChart = (new BarChart())->setStyle(
            (new BarChartStyle())
                ->setBarWidth(4)
                ->setUnitHeight(1)
        );
        $barChart->addBar(
            new Bar('a', 2)
        )
            ->addBar(
                new Bar('b', 5)
            );

        $this->addFigure($barChart);


        $expected = <<<EOD
        |.....****
        |.....*..*
        |.....*..*
        |****.*..*
        |****.****
        |_a____b__
        EOD;

        $this->assertRender($expected);
    }

}
