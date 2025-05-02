<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Chart\Function;

use ConsoleDraw\Figure\Chart\Function\FunctionGraph;
use ConsoleDraw\Figure\Chart\Function\FunctionValue;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class FunctionGraphTest extends FigureTestCase
{
    public function testAbsFunction(): void
    {
        $graph = new FunctionGraph();
        for ($x = 0; $x < 10; $x++) {
            $graph->addValue(new FunctionValue($x, abs($x - 4)));
        }

        $this->addFigure($graph);


        $expected = <<<EOD
        |........*
        *.......*.
        |*.....*..
        |.*...*...
        |..*.*....
        0---*-----
        EOD;

        $this->assertRender($expected);
    }

}
