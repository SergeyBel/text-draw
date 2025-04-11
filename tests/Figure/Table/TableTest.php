<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Table;

use ConsoleDraw\Figure\Table\Table;
use ConsoleDraw\Figure\Table\TableCell;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class TableTest extends FigureTestCase
{
    public function testTable(): void
    {
        $this->createDrawer(16, 7);

        $table = (new Table($this->getSize()))
            ->setHeader(['City', 'Value'])
            ->addRows([
                ['London', '12000'],
                ['New York', '540'],
            ]);
        $this->render->addFigure($table);


        $expected = <<<EOD
        +--------+-----+
        |City    |Value|
        +--------+-----+
        |London  |12000|
        +--------+-----+
        |New York|540  |
        +--------+-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testTableCell(): void
    {
        $this->createDrawer(14, 3);

        $table = (new Table($this->getSize()))
            ->addRows([
                ['London', new TableCell('12000')],
            ]);
        $this->render->addFigure($table);


        $expected = <<<EOD
        +------+-----+
        |London|12000|
        +------+-----+
        EOD;

        $this->assertRender($expected);
    }


}
