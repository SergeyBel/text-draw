<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagrams\BarChart;

use TextDraw\Figure\Diagrams\BarChart\Bar;
use TextDraw\Figure\Diagrams\BarChart\BarChart;
use TextDraw\Figure\Diagrams\BarChart\BarChartDrawer;
use TextDraw\Tests\Figure\FigureTestCase;

class BarChartDrawerTest extends FigureTestCase
{
    private BarChartDrawer $drawer;
    public function setUp(): void
    {
        $this->drawer = new BarChartDrawer();
    }

    public function testOneBar(): void
    {
        $barChart = new BarChart([new Bar(3, 'ab')]);

        $expected = <<<EOD
        +--+
        |..|
        +--+
        ab..
        EOD;

        $this->assertRender($expected, $this->drawer->draw($barChart));
    }

    public function testTwoBars(): void
    {
        $barChart = new BarChart([new Bar(3, 'a'), new Bar(2, 'b') ]);

        $expected = <<<EOD
        +--+.....
        |..|.+--+
        +--+.+--+
        a....b...
        EOD;

        $this->assertRender($expected, $this->drawer->draw($barChart));
    }

}
