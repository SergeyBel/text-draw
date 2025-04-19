<?php

declare(strict_types=1);

namespace Tests\Plane;

namespace ConsoleDraw\Tests\Plane;

use ConsoleDraw\Figure\Table\Table;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\ImageRender\ImageRender;
use ConsoleDraw\Render\ImageRender\ImageRenderStyle;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testAddX(): void
    {
        $point = new Point(0, 0);
        $this->assertEquals(1, $point->addX(1)->getX());
    }

}
