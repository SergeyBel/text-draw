<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Table;

use PHPUnit\Framework\TestCase;
use TextDraw\Figure\Table\TableBag\SizeMatrix;

class SizeMatrixTest extends TestCase
{
    public function testOneColumn(): void
    {
        $m = new SizeMatrix(
            [
                [2],
                [3]
            ]
        );
        $expected = [
            [3],
            [3]
        ];
        $this->assertSame($expected, $m->calculate());

    }

    public function testTwoColumns(): void
    {
        $m = new SizeMatrix(
            [
                [2, 3],
                [1, 5]
            ]
        );
        $expected = [
            [2, 5],
            [2, 5]
        ];
        $this->assertSame($expected, $m->calculate());
    }

    public function testColspanLess(): void
    {
        $m = new SizeMatrix(
            [
                [2, 3],
                [null, 4]
            ]
        );
        $expected = [
            [2, 3],
            [2, 3]
        ];
        $this->assertSame($expected, $m->calculate());
    }

    public function testColspanMore(): void
    {
        $m = new SizeMatrix(
            [
                [2, 3],
                [null, 6]
            ]
        );
        $expected = [
            [2, 4],
            [2, 4]
        ];
        $this->assertSame($expected, $m->calculate());
    }


}
