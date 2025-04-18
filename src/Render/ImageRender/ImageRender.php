<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ImageRender;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\RenderInterface;

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
        $lines = [];
        $charHeight = $this->getCharHeight();
        $imageWidth = 0;
        $imageHeight = 0;

        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            $line = '';
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                if ($this->matrix->hasPixel($x, $y)) {
                    $line .= $this->matrix->getPixel($x, $y)->getChar();
                }

            }
            if (mb_strlen($line) > 0) {
                $textWidth = $this->getTextWidth($line);
                $textHeight = $charHeight;
                $lines[] = new TextLine($line, $textWidth, $textHeight);
                $imageHeight += $textHeight;
                $imageWidth = max($imageWidth, $textWidth);
            }
        }

        $image = imagecreatetruecolor($imageWidth, $imageHeight);

        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);
        imagefill($image, 0, 0, $backgroundColor);

        $height = 0;
        foreach ($lines as $line) {
            $height += $line->getHeight();
            imagefttext($image, 16, 0, 0, $height, $textColor, './font/UbuntuMono-Regular.ttf', $line->getText());
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

    private function getTextWidth(string $text): int
    {
        $box = imageftbbox(16, 0, './font/UbuntuMono-Regular.ttf', $text);
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
