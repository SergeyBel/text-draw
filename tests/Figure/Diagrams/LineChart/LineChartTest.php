<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagrams\LineChart;

use TextDraw\Figure\Diagrams\LineChart\DatasetStyle;
use TextDraw\Figure\Diagrams\LineChart\LineChart;
use TextDraw\Figure\Diagrams\LineChart\LineChartStyle;
use TextDraw\Tests\Figure\FigureTestCase;

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
            ->addDataset([0, 3], $this->getDatasetStyle());


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
            ->addDataset([0, 2], $this->getDatasetStyle()->setLineChar('@'));


        $this->addFigure($lineChart);


        $expected = <<<EOD
        |..@
        |.@.
        -@--
        .a.b
        EOD;

        $this->assertRender($expected);
    }

    public function testDatasetStylePointChar(): void
    {
        $labels = ['a', 'b'];

        $lineChart = new LineChart(
            $labels
        )->setStyle($this->getStyle());

        $lineChart
            ->addDataset([0, 2], $this->getDatasetStyle()->setPointChar('@'));


        $this->addFigure($lineChart);


        $expected = <<<EOD
        |..@
        |.*.
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
