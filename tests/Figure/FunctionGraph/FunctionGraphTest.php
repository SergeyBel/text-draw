<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\FunctionGraph;

use ConsoleDraw\Figure\FunctionGraph\FunctionGraph;
use ConsoleDraw\Figure\FunctionGraph\FunctionValue;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class FunctionGraphTest extends FigureTestCase
{
    public function testAbsFunction(): void
    {
        $this->createDrawer(10, 10);

        $graph = new FunctionGraph($this->getSize());
        for ($x = 0; $x < 10; $x++) {
            $graph->addValue(new FunctionValue($x, abs($x - 4)));
        }


        $this->render->addFigure($graph);


        $expected = <<<EOD
        Y.........
        |.........
        |.........
        |.........
        |........*
        *.......*.
        |*.....*..
        |.*...*...
        |..*.*....
        0---*----X
        EOD;

        $this->assertRender($expected);
    }

}
