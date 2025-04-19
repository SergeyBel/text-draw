<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ImageRender;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\RenderInterface;
use GdImage;

class ImageRender implements RenderInterface
{
    private PixelMatrix $matrix;
    private Size $size;

    public function __construct(
        int $width,
        int $height,
    ) {
        $this->size = new Size($width, $height);
        $this->matrix = new PixelMatrix();
        $this->clear();
    }

    public function render(string $filename): void
    {
        $charWidth = $this->getCharWidth();
        $charHeight = $this->getCharHeight();
        $imageWidth = $this->size->getWidth() * $charWidth;
        $imageHeight = $this->size->getHeight() * $charHeight;

        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);
        imagefill($image, 0, 0, $backgroundColor);

        foreach ($this->matrix->getPixels() as $pixel) {
            $this->drawPixel($image, $pixel, $charWidth, $charHeight, $textColor);
        }

        imagepng($image, $filename);
        imagedestroy($image);
    }

    public function addFigure(FigureInterface $figure): static
    {
        $this->matrix->merge($figure->draw());
        return $this;
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function clear(): void
    {
        $this->matrix->clear();
    }

    private function drawPixel(GdImage $image, Pixel $pixel, int $charWidth, int $charHeight, int $textColor): void
    {
        $x = $pixel->getPoint()->getX() * $charWidth;
        $y = ($pixel->getPoint()->getY() + 1) * $charHeight;

        imagefttext($image, 16, 0, $x, $y, $textColor, './font/UbuntuMono-Regular.ttf', $pixel->getChar());
    }

    private function getCharWidth(): int
    {
        $box = imageftbbox(16, 0, './font/UbuntuMono-Regular.ttf', 'W');
        return abs($box[2] - $box[0]);
    }


    private function getCharHeight(): int
    {
        /**
         * imageftbbox has a bug on determine char height so use one height for all symbols
         * see https://www.php.net/manual/ru/function.imagettfbbox.php#97211
         */
        $box = imageftbbox(16, 0, './font/UbuntuMono-Regular.ttf', '|');
        return abs($box[1] - $box[7]);
    }
}
