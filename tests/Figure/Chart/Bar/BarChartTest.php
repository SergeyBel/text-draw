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
        $this->createDrawer(11, 11);

        $barChart = new BarChart($this->getSize());
        $barChart->addBar(
            new Bar('a', 2)
        )
            ->addBar(
                new Bar('b', 5)
            );

        $this->render->addFigure($barChart);


        $expected = <<<EOD
        |......****
        |......*..*
        |......*..*
        |......*..*
        |......*..*
        |......*..*
        |.****.*..*
        |.*..*.*..*
        |.*..*.*..*
        |.****.****
        |_a____b___
        EOD;

        $this->assertRender($expected);
    }

}
