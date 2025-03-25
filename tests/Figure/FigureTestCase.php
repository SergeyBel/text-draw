<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure;

use ConsoleDraw\Drawer;
use ConsoleDraw\DrawerStyle;
use PHPUnit\Framework\TestCase;

class FigureTestCase extends TestCase
{
    protected Drawer $drawer;

    protected function createDrawer(int $width = 5, int $height = 5): void
    {
        $this->drawer = (new Drawer($width, $height))
            ->setStyle(
                (new DrawerStyle())
                    ->setEmptySymbol('.')
            );
    }

    protected function assertRender(string $expected)
    {
        $this->assertSame($expected."\n", $this->drawer->render());
    }

}
