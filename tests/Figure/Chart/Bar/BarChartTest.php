<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Chart\Bar;

use ConsoleDraw\Figure\Chart\Bar\Bar;
use ConsoleDraw\Figure\Chart\Bar\BarChart;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class BarChartTest extends FigureTestCase
{
    public function testBarChart(): void
    {
        $barChart = new BarChart();
        $barChart->addBar(
            new Bar('a', 2)
        )
            ->addBar(
                new Bar('b', 5)
            );


        $this->createDrawer(10, 11);
        $this->drawer->addFigure($barChart);


        $expected = <<<EOD
        ......****
        ......*..*
        ......*..*
        ......*..*
        ......*..*
        ......*..*
        .****.*..*
        .*..*.*..*
        .*..*.*..*
        .****.****
        .a....b...
        EOD;

        $this->assertRender($expected);
    }

}
