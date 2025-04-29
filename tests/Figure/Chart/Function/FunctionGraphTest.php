<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Chart\Function;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Chart\Function\FunctionGraph;
use ConsoleDraw\Figure\Chart\Function\FunctionValue;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class FunctionGraphTest extends FigureTestCase
{
    public function testAbsFunction(): void
    {
        $this->createDrawer();

        $graph = new FunctionGraph(new Size(10, 10));
        for ($x = 0; $x < 10; $x++) {
            $graph->addValue(new FunctionValue($x, abs($x - 4)));
        }


        $this->render->addFigure($graph);


        $expected = <<<EOD
        ^.........
        |.........
        |.........
        |.........
        |........*
        *.......*.
        |*.....*..
        |.*...*...
        |..*.*....
        0---*---->
        EOD;

        $this->assertRender($expected);
    }

}
