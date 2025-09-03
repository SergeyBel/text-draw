<?php

declare(strict_types=1);

namespace TextDraw\Tests\Screen;

use PHPUnit\Framework\TestCase;
use TextDraw\Common\Exception\RenderException;
use TextDraw\Common\Size;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class ScreenTest extends TestCase
{
    public function testCreate(): void
    {
        $pixel = new Pixel(new Point(1, 2), '+');
        $matrix = new Screen([$pixel]);

        $this->assertTrue($matrix->hasPixel(1, 2));
        $this->assertEquals($pixel, $matrix->getPixel(1, 2));
    }

    public function testSetPixel(): void
    {
        $matrix = new Screen();
        $pixel = new Pixel(new Point(1, 2), '+');

        $matrix->setPixel($pixel);

        $this->assertTrue($matrix->hasPixel(1, 2));
        $this->assertEquals($pixel, $matrix->getPixel(1, 2));
    }

    public function testDontHasPixel(): void
    {
        $matrix = new Screen();
        $this->assertFalse($matrix->hasPixel(1, 2));
    }

    public function testCantGetPixel(): void
    {
        $matrix = new Screen();

        $this->expectException(RenderException::class);
        $matrix->getPixel(1, 2);
    }

    public function testGetPixels(): void
    {
        $pixels = [
            new Pixel(new Point(1, 2), '+'),
            new Pixel(new Point(3, 4), '+')
        ];
        $matrix = new Screen()->setPixels($pixels);

        $this->assertEquals($pixels, $matrix->getPixels());
    }

    public function testMerge(): void
    {
        $pixel1 = new Pixel(new Point(1, 2), '+');
        $pixel2 = new Pixel(new Point(3, 4), '+');
        $pixel3 = new Pixel(new Point(1, 2), '@');


        $matrix1 = new Screen()->setPixel($pixel1);
        $matrix2 = new Screen()->setPixels([$pixel2, $pixel3]);

        $pixels = [
            $pixel3,
            $pixel2
        ];

        $this->assertEquals($pixels, $matrix1->merge($matrix2)->getPixels());
    }

    public function testClear(): void
    {
        $pixel = new Pixel(new Point(1, 2), '+');
        $matrix = new Screen()->setPixel($pixel);

        $this->assertEquals([], $matrix->clear()->getPixels());
    }


    public function testMinHull(): void
    {
        $pixels = [
            new Pixel(new Point(1, 5), '+'),
            new Pixel(new Point(3, 2), '+'),
        ];
        $matrix = new Screen()->setPixels($pixels);

        $size = new Size(4, 6);
        $this->assertEquals($size, $matrix->getSize());
    }

    public function testMinHullZeroPoint(): void
    {
        $pixel = new Pixel(new Point(0, 0), '+');
        $matrix = new Screen()->setPixel($pixel);

        $size = new Size(1, 1);
        $this->assertEquals($size, $matrix->getSize());
    }

}
