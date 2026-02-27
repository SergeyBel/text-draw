<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagrams\BarChart;

use TextDraw\Figure\Diagrams\BarChart\BarChart;
use TextDraw\Figure\Diagrams\BarChart\BarChartStyle;
use TextDraw\Figure\Diagrams\BarChart\DatasetStyle;
use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;
use TextDraw\Tests\Figure\FigureTestCase;

class BarChartTest extends FigureTestCase
{
    public function testOneDataset(): void
    {
        $barChart = new BarChart(['a', 'b'])
                ->setStyle($this->getStyle());

        $barChart
            ->addDataset([2, 5], $this->getDatasetStyle());

        $this->addFigure($barChart);

        $expected = <<<EOD
        |.....****
        |.....*..*
        |.....*..*
        |****.*..*
        |****.****
        |.a....b..
        EOD;

        $this->assertRender($expected);
    }

    public function testTwoDatasets(): void
    {
        $barChart = new BarChart(['a', 'b'])
            ->setStyle($this->getStyle());

        $barChart
            ->addDataset([1, 2], $this->getDatasetStyle())
            ->addDataset([3, 4], $this->getDatasetStyle());

        $this->addFigure($barChart);

        $expected = <<<EOD
        |.............****
        |....****.....*..*
        |....*..*.*****..*
        |********.********
        |...a........b....
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleBarWidth(): void
    {
        $style = $this->getStyle()->setBarWidth(3);
        $barChart = new BarChart(['a'])
                ->setStyle($style);

        $barChart->addDataset([3], $this->getDatasetStyle());

        $this->addFigure($barChart);


        $expected = <<<EOD
        |***
        |*.*
        |***
        |.a.
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleUnitHeigh(): void
    {
        $style = $this->getStyle()->setUnitHeight(2);
        $barChart = new BarChart(['a'])
                ->setStyle($style);

        $barChart->addDataset([2], $this->getDatasetStyle());

        $this->addFigure($barChart);


        $expected = <<<EOD
        |****
        |*..*
        |*..*
        |****
        |.a..
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleGap(): void
    {
        $style = $this->getStyle()->setGap(2);
        $barChart = new BarChart(['a', 'b'])
                ->setStyle($style);

        $barChart->addDataset([2, 5], $this->getDatasetStyle());

        $this->addFigure($barChart);

        $expected = <<<EOD
        |......****
        |......*..*
        |......*..*
        |****..*..*
        |****..****
        |.a.....b..
        EOD;

        $this->assertRender($expected);
    }

    public function testDatasetStyleRectangle(): void
    {
        $style = $this->getStyle();
        $barChart = new BarChart(['a'])
            ->setStyle($style);

        $barChart->addDataset(
            [3],
            $this->getDatasetStyle()->setBarStyle(
                new RectangleStyle()
                    ->setVerticalChar('|')
                    ->setHorizontalChar('-')
                    ->setCrossingChar('+')
            )
        );

        $this->addFigure($barChart);


        $expected = <<<EOD
        |+--+
        ||..|
        |+--+
        |.a..
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): BarChartStyle
    {
        return new BarChartStyle()
            ->setBarWidth(4)
            ->setUnitHeight(1)
            ->setGap(1)
        ;
    }

    private function getDatasetStyle(): DatasetStyle
    {
        return new DatasetStyle()
            ->setBarStyle(new RectangleStyle()->setChar('*'))
        ;
    }

}
