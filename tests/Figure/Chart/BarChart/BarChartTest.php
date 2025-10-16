<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Chart\BarChart;

use TextDraw\Figure\Chart\BarChart\Bar;
use TextDraw\Figure\Chart\BarChart\BarChart;
use TextDraw\Figure\Chart\BarChart\BarChartStyle;
use TextDraw\Tests\Figure\FigureTestCase;

class BarChartTest extends FigureTestCase
{
    public function testBarChart(): void
    {
        $barChart = new BarChart()
                ->setStyle($this->getStyle());

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

    public function testStyleBarWidth(): void
    {
        $style = $this->getStyle()->setBarWidth(3);
        $barChart = new BarChart()
                ->setStyle($style);

        $barChart->addBar(
            new Bar('a', 5)
        );

        $this->addFigure($barChart);


        $expected = <<<EOD
        |***
        |*.*
        |*.*
        |*.*
        |***
        |_a_
        EOD;

        $this->assertRender($expected);
    }


    public function testStyleUnitHeigh(): void
    {
        $style = $this->getStyle()->setUnitHeight(2);
        $barChart = new BarChart()
                ->setStyle($style);

        $barChart->addBar(
            new Bar('a', 2)
        );

        $this->addFigure($barChart);


        $expected = <<<EOD
        |****
        |*..*
        |*..*
        |****
        |_a__
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleVerticalChar(): void
    {
        $style = $this->getStyle()->setVerticalChar('|');
        $barChart = new BarChart()
                ->setStyle($style);

        $barChart->addBar(
            new Bar('a', 5)
        );

        $this->addFigure($barChart);


        $expected = <<<EOD
        |****
        ||..|
        ||..|
        ||..|
        |****
        |_a__
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleHorizontalChar(): void
    {
        $style = $this->getStyle()->setHorizontalChar('-');
        $barChart = new BarChart()
                ->setStyle($style);

        $barChart->addBar(
            new Bar('a', 5)
        );

        $this->addFigure($barChart);


        $expected = <<<EOD
        |*--*
        |*..*
        |*..*
        |*..*
        |*--*
        |_a__
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleGap(): void
    {
        $style = $this->getStyle()->setGap(2);
        $barChart = new BarChart()
                ->setStyle($style);

        $barChart->addBar(
            new Bar('a', 2)
        )
            ->addBar(
                new Bar('b', 5)
            );

        $this->addFigure($barChart);


        $expected = <<<EOD
        |......****
        |......*..*
        |......*..*
        |****..*..*
        |****..****
        |_a_____b__
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleCrossingChar(): void
    {
        $style = $this->getStyle()->setCrossingChar('+');
        $barChart = new BarChart()
                ->setStyle($style);

        $barChart->addBar(
            new Bar('a', 5)
        );

        $this->addFigure($barChart);


        $expected = <<<EOD
        |+**+
        |*..*
        |*..*
        |*..*
        |+**+
        |_a__
        EOD;

        $this->assertRender($expected);
    }



    private function getStyle(): BarChartStyle
    {
        return new BarChartStyle()
                ->setBarWidth(4)
                ->setUnitHeight(1)
                ->setChar('*')
                ->setGap(1)
        ;

    }

}
