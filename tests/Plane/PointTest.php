<?php

declare(strict_types=1);

namespace Tests\Plane;

namespace TextDraw\Tests\Plane;

use TextDraw\Plane\Point;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testAddX(): void
    {
        $point = new Point(0, 0);
        $this->assertEquals(1, $point->addX(1)->getX());
    }

}
