<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Pixel;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Common\Size;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Plane\Point;
use PHPUnit\Framework\TestCase;

class PixelMatrixTest extends TestCase
{
    public function testCreate(): void
    {
        $pixel = new Pixel(new Point(1, 2), '+');
        $matrix = new PixelMatrix([$pixel]);

        $this->assertTrue($matrix->hasPixel(1, 2));
        $this->assertEquals($pixel, $matrix->getPixel(1, 2));
    }

    public function testSetPixel(): void
    {
        $matrix = new PixelMatrix();
        $pixel = new Pixel(new Point(1, 2), '+');

        $matrix->setPixel($pixel);

        $this->assertTrue($matrix->hasPixel(1, 2));
        $this->assertEquals($pixel, $matrix->getPixel(1, 2));
    }

    public function testDontHasPixel(): void
    {
        $matrix = new PixelMatrix();
        $this->assertFalse($matrix->hasPixel(1, 2));
    }

    public function testCantGetPixel(): void
    {
        $matrix = new PixelMatrix();

        $this->expectException(RenderException::class);
        $matrix->getPixel(1, 2);
    }

    public function testGetPixels(): void
    {
        $pixels = [
            new Pixel(new Point(1, 2), '+'),
            new Pixel(new Point(3, 4), '+')
        ];
        $matrix = new PixelMatrix()->setPixels($pixels);

        $this->assertEquals($pixels, $matrix->getPixels());
    }

    public function testMerge(): void
    {
        $pixel1 = new Pixel(new Point(1, 2), '+');
        $pixel2 = new Pixel(new Point(3, 4), '+');
        $pixel3 = new Pixel(new Point(1, 2), '@');


        $matrix1 = new PixelMatrix()->setPixel($pixel1);
        $matrix2 = new PixelMatrix()->setPixels([$pixel2, $pixel3]);

        $pixels = [
            $pixel3,
            $pixel2
        ];

        $this->assertEquals($pixels, $matrix1->merge($matrix2)->getPixels());
    }

    public function testClear(): void
    {
        $pixel = new Pixel(new Point(1, 2), '+');
        $matrix = new PixelMatrix()->setPixel($pixel);

        $this->assertEquals([], $matrix->clear()->getPixels());
    }


    public function testMinHull(): void
    {
        $pixels = [
            new Pixel(new Point(1, 5), '+'),
            new Pixel(new Point(3, 2), '+'),
        ];
        $matrix = new PixelMatrix()->setPixels($pixels);

        $size = new Size(4, 6);
        $this->assertEquals($size, $matrix->getMinHullSize());
    }

    public function testMinHullZeroPoint(): void
    {
        $pixel = new Pixel(new Point(0, 0), '+');
        $matrix = new PixelMatrix()->setPixel($pixel);

        $size = new Size(1, 1);
        $this->assertEquals($size, $matrix->getMinHullSize());
    }

}
