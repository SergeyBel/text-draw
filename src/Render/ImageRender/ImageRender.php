<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ImageRender;

use ConsoleDraw\Common\Color\RgbColor;
use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Frame\Frame;
use Exception;
use GdImage;

class ImageRender
{
    private ?Size $size;
    private ImageRenderStyle $style;

    public function __construct(
        ?Size $size = null
    ) {
        $this->size = $size;

        $this->style = new ImageRenderStyle();
    }

    public function render(Frame $frame, string $filepath): Image
    {
        $matrix = $frame->draw();

        if (is_null($this->size)) {
            $this->size = $matrix->getMinHull();
        }

        $charSize = new Size($this->getCharWidth(), $this->getCharHeight());
        $imageSize = new Size($this->size->getWidth() * $charSize->getWidth(), $this->size->getHeight() * $charSize->getHeight());

        $image = $this->createImage($imageSize);
        $this->drawPixels($matrix, $image, $charSize);
        $this->saveImage($filepath, $image);
        return new Image($filepath, $imageSize);
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

    private function createImage(Size $imageSize): GdImage
    {
        $image = imagecreatetruecolor($imageSize->getWidth(), $imageSize->getHeight());
        if ($image === false) {
            throw new Exception('Cannot create image');
        }
        $backgroundColor = $this->createColor($image, $this->style->getBackgroundColor());

        imagefill($image, 0, 0, $backgroundColor);

        return $image;
    }

    private function drawPixels(PixelMatrix $matrix, GdImage $image, Size $charSize): void
    {
        $textColor = $this->createColor($image, $this->style->getTextColor());

        foreach ($matrix->getPixels() as $pixel) {
            $this->drawPixel($image, $pixel, $charSize, $textColor);
        }
    }


    private function drawPixel(GdImage $image, Pixel $pixel, Size $charSize, int $textColor): void
    {
        $x = $pixel->getPoint()->getX() * $charSize->getWidth();
        $y = ($pixel->getPoint()->getY() + 1) * $charSize->getHeight();

        imagefttext($image, $this->style->getFontSize(), 0, $x, $y, $textColor, $this->style->getFont(), $pixel->getChar());
    }

    private function saveImage(string $filename, GdImage $image): void
    {
        imagepng($image, $filename);
        imagedestroy($image);
    }

    private function createColor(GdImage $image, RgbColor $color): int
    {
        $imageColor = imagecolorallocate(
            $image,
            $color->getRed(),
            $color->getGreen(),
            $color->getBlue()
        );
        if ($imageColor === false) {
            throw new Exception('Cannot create color');
        }
        return $imageColor;
    }



    private function getCharWidth(): int
    {
        $box = imageftbbox($this->style->getFontSize(), 0, $this->style->getFont(), 'W');
        if ($box === false) {
            throw new Exception('Cannot get char width');
        }
        return abs($box[2] - $box[0]);
    }

    private function getCharHeight(): int
    {
        /**
         * imageftbbox has a bug on determine char height so use one height for all symbols
         * see https://www.php.net/manual/ru/function.imagettfbbox.php#97211
         */
        $box = imageftbbox($this->style->getFontSize(), 0, $this->style->getFont(), '|');
        if ($box === false) {
            throw new Exception('Cannot get char height');
        }
        return abs($box[1] - $box[7]);
    }
}
