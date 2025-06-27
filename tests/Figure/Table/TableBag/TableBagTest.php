<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Table;

use PHPUnit\Framework\TestCase;
use TextDraw\Common\TextFrame;
use TextDraw\Figure\Table\TableBag\TableBag;
use TextDraw\Figure\Table\TableCell;

class TableBagTest extends TestCase
{
    public function testOneSimpleColumn(): void
    {
        $bag = new TableBag();
        $bag
            ->addRow(
                [new TableCell('11')]
            )
            ->addRow(
                [new TableCell('111')]
            );
        $expected = [
            [new TextFrame('11', 3)],
            [new TextFrame('111', 3)],
        ];
        $this->assertEquals($expected, $bag->getTable());

    }


}
