<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Table;

use TextDraw\Common\TextAlign;
use TextDraw\Figure\Table\Table;
use TextDraw\Figure\Table\TableCell;
use TextDraw\Figure\Table\TableStyle;
use TextDraw\Tests\Figure\FigureTestCase;

class TableTest extends FigureTestCase
{
    public function testTable(): void
    {
        $table = new Table()
            ->setHeader(['City', 'Value'])
            ->addRows([
                ['London', '12000'],
                ['New York', '540'],
            ])->setStyle($this->getStyle());
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

        $table = new Table()
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

        $table = new Table()
            ->addRows([
                ['London', '12000'],
                [new TableCell('Boston123', 2)],
            ]);
        $this->addFigure($table);


        $expected = <<<EOD
        +------+-----+
        |London|12000|
        +------------+
        |Boston123   |
        +------------+
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleHeaderAlignCenter(): void
    {
        $style = $this->getStyle()->setHeaderAlign(TextAlign::Center);

        $table = new Table()
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

    public function testStyleAlignCenter(): void
    {
        $style = $this->getStyle()->setAlign(TextAlign::Center);

        $table = new Table()
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

    private function getStyle(): TableStyle
    {
        return new TableStyle()
                    ->setVerticalChar('|')
                    ->setHorizontalChar('-')
                ->setCrossingChar('+')
                ->setPaddingChar(' ')
                ->setAlign(TextAlign::Left)
                ->setHeaderAlign(TextAlign::Left)
        ;
    }
}
