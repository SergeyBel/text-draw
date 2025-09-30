<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Chart\Function;

use TextDraw\Figure\Chart\Function\FunctionGraph;
use TextDraw\Figure\Chart\Function\FunctionValue;
use TextDraw\Tests\Figure\FigureTestCase;
use TextDraw\Figure\Chart\Function\FunctionGraphStyle;

class FunctionGraphTest extends FigureTestCase
{
    public function testAbsFunction(): void
    {
        $graph = new FunctionGraph()->setStyle($this->getStyle());
        for ($x = 0; $x < 10; $x++) {
            $graph->addValue(new FunctionValue($x, abs($x - 4)));
        }

        $this->addFigure($graph);


        $expected = <<<EOD
        ^........*
        *.......*.
        |*.....*..
        |.*...*...
        |..*.*....
        0---*---->
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): FunctionGraphStyle
    {
        return new FunctionGraphStyle()
                    ->setPointSymbol('*')
                    ->setZeroSymbol('0');
    }

}
