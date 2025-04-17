<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ImageRender;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\RenderInterface;
use Exception;

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
        $width = $this->size->getWidth();
        $height = $this->size->getHeight();

        if (!($width >= 1 && $height >= 1)) {
            throw new Exception('Image size must be greater than 0');
        }
        $image = imagecreatetruecolor($width, $height);

        $backgroundColor = imagecolorallocate($image, 255, 255, 255);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        if ($backgroundColor === false || $textColor === false) {
            throw new Exception('Image color allocation error');
        }

        imagefill($image, 0, 0, $backgroundColor);

        for ($y = 0; $y < $this->size->getHeight(); $y++) {
            for ($x = 0; $x < $this->size->getWidth(); $x++) {
                if ($this->matrix->hasPixel($x, $y)) {
                    imagefttext($image, 19, 0, $x, $y, $textColor, './font/OpenSans.ttf', $this->matrix->getPixel($x, $y)->getChar());
                }
            }
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


}
