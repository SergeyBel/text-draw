<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Chart\LineChart;

use TextDraw\Figure\Chart\LineChart\LineChart;
use TextDraw\Tests\Figure\FigureTestCase;
use TextDraw\Figure\Chart\LineChart\LineChartStyle;

class LineChartTest extends FigureTestCase
{
    public function testOneDataset(): void
    {
        $labels = ['7', '10', '5'];

        $lineChart = new LineChart(
            $labels
        )->setStyle($this->getStyle());

        $lineChart->addDataset([7, 10, 5]);


        $this->addFigure($lineChart);


        $expected = <<<EOD
        |...*....
        |..*.*...
        |.*...*..
        |*....*..
        |......*.
        --------*
        .7..10..5
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): LineChartStyle
    {
        return new LineChartStyle();
    }

}
