<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ImageRender;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\RenderInterface;
use GdImage;
use function Symfony\Component\String\s;

class ImageRender implements RenderInterface
{
    private PixelMatrix $matrix;
    private Size $size;
    private ImageRenderStyle $style;

    public function __construct(
        int $width,
        int $height,
    ) {
        $this->size = new Size($width, $height);
        $this->matrix = new PixelMatrix();

        $this->style = new ImageRenderStyle();
        $this->clear();
    }

    public function render(string $filename): void
    {
        $charWidth = $this->getCharWidth();
        $charHeight = $this->getCharHeight();
        $imageWidth = $this->size->getWidth() * $charWidth;
        $imageHeight = $this->size->getHeight() * $charHeight;

        $image = $this->createImage($imageWidth, $imageHeight);
        $this->drawPixels($image, $charWidth, $charHeight);
        $this->saveImage($filename, $image);
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

    public function getStyle(): ImageRenderStyle
    {
        return $this->style;
    }

    public function setStyle(ImageRenderStyle $style): static
    {
        $this->style = $style;
        return $this;
    }

    private function createImage(int $imageWidth, int $imageHeight): GdImage
    {
        $image = imagecreatetruecolor($imageWidth, $imageHeight);
        $backgroundColor = imagecolorallocate(
            $image,
            $this->style->getBackgroundColor()->getRed(),
            $this->style->getBackgroundColor()->getGreen(),
            $this->style->getBackgroundColor()->getBlue()
        );

        imagefill($image, 0, 0, $backgroundColor);

        return $image;
    }

    private function drawPixels(GdImage $image, int $charWidth, int $charHeight): void
    {
        $textColor = imagecolorallocate(
            $image,
            $this->style->getTextColor()->getRed(),
            $this->style->getTextColor()->getGreen(),
            $this->style->getTextColor()->getBlue()
        );
        foreach ($this->matrix->getPixels() as $pixel) {
            $this->drawPixel($image, $pixel, $charWidth, $charHeight, $textColor);
        }
    }


    private function drawPixel(GdImage $image, Pixel $pixel, int $charWidth, int $charHeight, int $textColor): void
    {
        $x = $pixel->getPoint()->getX() * $charWidth;
        $y = ($pixel->getPoint()->getY() + 1) * $charHeight;

        imagefttext($image, $this->style->getFontSize(), 0, $x, $y, $textColor, $this->style->getFont(), $pixel->getChar());
    }

    private function saveImage(string $filename, GdImage $image): void
    {
        imagepng($image, $filename);
        imagedestroy($image);
    }

    private function getCharWidth(): int
    {
        $box = imageftbbox($this->style->getFontSize(), 0, $this->style->getFont(), 'W');
        return abs($box[2] - $box[0]);
    }


    private function getCharHeight(): int
    {
        /**
         * imageftbbox has a bug on determine char height so use one height for all symbols
         * see https://www.php.net/manual/ru/function.imagettfbbox.php#97211
         */
        $box = imageftbbox($this->style->getFontSize(), 0, $this->style->getFont(), '|');
        return abs($box[1] - $box[7]);
    }
}
