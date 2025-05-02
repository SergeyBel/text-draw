<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Table;

use ConsoleDraw\Figure\Table\Table;
use ConsoleDraw\Figure\Table\TableCell;
use ConsoleDraw\Figure\Table\TableStyle;
use ConsoleDraw\Figure\Text\TextAlign;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class TableTest extends FigureTestCase
{
    public function testTable(): void
    {
        $table = (new Table())
            ->setHeader(['City', 'Value'])
            ->addRows([
                ['London', '12000'],
                ['New York', '540'],
            ]);
        $this->addFigure($table);


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

        $table = (new Table())
            ->addRows([
                ['London', new TableCell('12000')],
            ]);
        $this->addFigure($table);


        $expected = <<<EOD
        +------+-----+
        |London|12000|
        +------+-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testTableColspan(): void
    {

        $table = (new Table())
            ->addRows([
                ['London', '12000'],
                [new TableCell('Boston', 2)],
            ]);
        $this->addFigure($table);


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
        $table = (new Table())
            ->addRows([
                ['London', new TableCell('12000')],
            ]);
        $table->setStyle((new TableStyle())->setColumnMaxWidth(5));
        $this->addFigure($table);


        $expected = <<<EOD
        +-----+-----+
        |Londo|12000|
        +-----+-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testHeaderAlignCenter(): void
    {
        $style = (new TableStyle())->setHeaderAlign(TextAlign::Center);

        $table = (new Table())
            ->setHeader(['City', 'Value'])
            ->addRows([
                ['London', '12000'],
            ])->setStyle($style);
        $this->addFigure($table);


        $expected = <<<EOD
        +------+-----+
        | City |Value|
        +------+-----+
        |London|12000|
        +------+-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testAlignCenter(): void
    {
        $style = (new TableStyle())->setAlign(TextAlign::Center);

        $table = (new Table())
            ->setHeader(['City', 'Value'])
            ->addRows([
                ['London', '1'],
            ])->setStyle($style);
        $this->addFigure($table);


        $expected = <<<EOD
        +------+-----+
        |City  |Value|
        +------+-----+
        |London|  1  |
        +------+-----+
        EOD;

        $this->assertRender($expected);
    }
}
