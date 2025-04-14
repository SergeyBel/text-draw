<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Table;

use ConsoleDraw\Figure\Table\Table;
use ConsoleDraw\Figure\Table\TableCell;
use ConsoleDraw\Figure\Table\TableStyle;
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

    public function testTableColspan(): void
    {
        $this->createDrawer(14, 5);

        $table = (new Table($this->getSize()))
            ->addRows([
                ['London', '12000'],
                [new TableCell('Boston', 2)],
            ]);
        $this->render->addFigure($table);


        $expected = <<<EOD
        +------+-----+
        |London|12000|
        +------+-----+
        |Boston      |
        +------+-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testTableCellMaxWidth(): void
    {
        $this->createDrawer(13, 3);

        $table = (new Table($this->getSize()))
            ->addRows([
                ['London', new TableCell('12000')],
            ]);
        $table->setStyle((new TableStyle())->setColumnMaxWidth(5));
        $this->render->addFigure($table);


        $expected = <<<EOD
        +-----+-----+
        |Londo|12000|
        +-----+-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testTableAlignRight(): void
    {
        $this->createDrawer(14, 5);

        $table = (new Table($this->getSize()))
            ->setHeader(['City', 'Value'])
            ->addRows([
                ['London', '12000'],
            ]);
        $style = (new TableStyle())->alignRight();
        $this->render->addFigure($table->setStyle($style));


        $expected = <<<EOD
        +------+-----+
        |  City|Value|
        +------+-----+
        |London|12000|
        +------+-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testTableAlignCenter(): void
    {
        $this->createDrawer(14, 5);

        $table = (new Table($this->getSize()))
            ->setHeader(['City', 'Value'])
            ->addRows([
                ['London', '12000'],
            ]);
        $style = (new TableStyle())->alignCenter();
        $this->render->addFigure($table->setStyle($style));


        $expected = <<<EOD
        +------+-----+
        | City |Value|
        +------+-----+
        |London|12000|
        +------+-----+
        EOD;

        $this->assertRender($expected);
    }


}
