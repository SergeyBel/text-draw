<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure;

use ConsoleDraw\Drawer;
use ConsoleDraw\DrawerStyle;
use PHPUnit\Framework\TestCase;

class FigureTestCase extends TestCase
{
    protected Drawer $drawer;

    protected function createDrawer(int $width, int $height, string $emptySymbol = '.'): void
    {
        $this->drawer = (new Drawer($width, $height))
            ->setStyle(
                (new DrawerStyle())
                    ->setEmptySymbol($emptySymbol)
            );
    }

    protected function assertRender(string $expected)
    {
        $this->assertSame($expected."\n", $this->drawer->render());
    }

}
