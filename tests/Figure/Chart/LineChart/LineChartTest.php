<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Chart\LineChart;

use TextDraw\Figure\Chart\LineChart\DatasetStyle;
use TextDraw\Figure\Chart\LineChart\LineChart;
use TextDraw\Tests\Figure\FigureTestCase;
use TextDraw\Figure\Chart\LineChart\LineChartStyle;

class LineChartTest extends FigureTestCase
{
    public function testOneDataset(): void
    {
        $labels = ['a', 'bb', 'c'];

        $lineChart = new LineChart(
            $labels
        )->setStyle($this->getStyle());

        $lineChart->addDataset([1, 3, 0], $this->getDatasetStyle());


        $this->addFigure($lineChart);


        $expected = <<<EOD
        |..*...
        |.*.*..
        |*...*.
        ------*
        .a.bb.c
        EOD;

        $this->assertRender($expected);
    }

    public function testDatasetWithNull(): void
    {
        $labels = ['a', 'b', 'c'];

        $lineChart = new LineChart(
            $labels
        )->setStyle($this->getStyle());

        $lineChart->addDataset([4, null, 0], $this->getDatasetStyle());


        $this->addFigure($lineChart);


        $expected = <<<EOD
        |*....
        |.*...
        |..*..
        |...*.
        -----*
        .a.b.c
        EOD;

        $this->assertRender($expected);
    }

    public function testTwoDatasets(): void
    {
        $labels = ['a', 'b'];

        $lineChart = new LineChart(
            $labels
        )->setStyle($this->getStyle());

        $lineChart
            ->addDataset([0, 2], $this->getDatasetStyle())
            ->addDataset([1, 3], $this->getDatasetStyle());


        $this->addFigure($lineChart);


        $expected = <<<EOD
        |..*
        |.**
        |**.
        -*--
        .a.b
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleLabelGap(): void
    {
        $labels = ['a', 'b'];

        $lineChart = new LineChart(
            $labels
        )->setStyle($this->getStyle()->setLabelGap(2));

        $lineChart
            ->addDataset([0, 3], new DatasetStyle());


        $this->addFigure($lineChart);


        $expected = <<<EOD
        |...*
        |..*.
        |.*..
        -*---
        .a..b
        EOD;

        $this->assertRender($expected);
    }

    public function testDatasetStyleLineChar(): void
    {
        $labels = ['a', 'b'];

        $lineChart = new LineChart(
            $labels
        )->setStyle($this->getStyle());

        $lineChart
            ->addDataset([0, 2], new DatasetStyle()->setLineChar('@'));


        $this->addFigure($lineChart);


        $expected = <<<EOD
        |..@
        |.@.
        -@--
        .a.b
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): LineChartStyle
    {
        return new LineChartStyle()->setLabelGap(1);
    }

    private function getDatasetStyle(): DatasetStyle
    {
        return new DatasetStyle()->setLineChar('*');
    }

}
