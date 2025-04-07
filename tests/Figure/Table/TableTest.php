<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Table;

use ConsoleDraw\Figure\Table\Table;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class TableTest extends FigureTestCase
{
    public function testTable(): void
    {
        $this->createDrawer(76, 11);

        $table = (new Table($this->getSize()))
            ->setHeader(['ISBN', 'Title', 'Author'])
            ->setRows([
                ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
                ['9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'],
                ['960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'],
                ['80-902734-1-6', 'And Then There Were None', 'Agatha Christie'],
            ]);
        $this->render->addFigure($table);


        $expected = <<<EOD
        +------------------------+------------------------+------------------------+
        |ISBN                    |Title                   |Author                  |
        +------------------------+------------------------+------------------------+
        |99921-58-10-7           |Divine Comedy           |Dante Alighieri         |
        +------------------------+------------------------+------------------------+
        |9971-5-0210-0           |A Tale of Two Cities    |Charles Dickens         |
        +------------------------+------------------------+------------------------+
        |960-425-059-0           |The Lord of the Rings   |J. R. R. Tolkien        |
        +------------------------+------------------------+------------------------+
        |80-902734-1-6           |And Then There Were None|Agatha Christie         |
        +------------------------+------------------------+------------------------+
        EOD;

        $this->assertRender($expected);
    }

}
