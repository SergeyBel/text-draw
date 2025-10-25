<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Table\TableBag;

use PHPUnit\Framework\TestCase;
use TextDraw\Common\HorizontalAlign;
use TextDraw\Figure\Table\TableBag\TableBag;
use TextDraw\Figure\Table\TableBag\TextCell;
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
            [new TextCell('11', 3, HorizontalAlign::Left)],
            [new TextCell('111', 3, HorizontalAlign::Left)],
        ];
        $this->assertEquals($expected, $bag->getTable());

    }


}
