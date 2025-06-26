<?php

declare(strict_types=1);

namespace TextDraw\Figure\Pixel;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Common\Size;
use Exception;

class PixelMatrix
{
    /**
     * @var Pixel[][]
     */
    private array $matrix = [];

    /**
     * @param array<Pixel> $pixels
     */
    public function __construct(array $pixels = [])
    {
        $this->setPixels($pixels);
    }

    public function setPixel(Pixel $pixel): static
    {
        $this->matrix[$pixel->getPoint()->getY()][$pixel->getPoint()->getX()] = $pixel;
        return $this;
    }


    public function getPixel(int $x, int $y): Pixel
    {
        if (!$this->hasPixel($x, $y)) {
            throw new RenderException('Pixel not found');
        }
        return $this->matrix[$y][$x];
    }

    public function hasPixel(int $x, int $y): bool
    {
        return isset($this->matrix[$y][$x]);
    }

    /**
     * @return Pixel[]
     */
    public function getPixels(): array
    {
        $pixels = [];
        foreach ($this->matrix as $line) {
            foreach ($line as $pixel) {
                $pixels[] = $pixel;
            }

        }
        return $pixels;
    }



    /**
     * @param array<Pixel> $pixels
     * @return $this
     */
    public function setPixels(array $pixels): static
    {
        foreach ($pixels as $pixel) {
            $this->setPixel($pixel);
        }
        return $this;
    }

    public function merge(PixelMatrix $pixelCollection): static
    {
        $this->setPixels($pixelCollection->getPixels());
        return $this;
    }


    public function clear(): static
    {
        $this->matrix = [];
        return $this;
    }

    public function getMinHullSize(): Size
    {
        $ys = array_keys($this->matrix);
        $xs = [];
        foreach ($this->matrix as $line) {
            $xs = array_merge($xs, array_keys($line));
        }

        if (count($ys) === 0 || count($xs) === 0) {
            throw new Exception('Can not get matrix size: empty');
        }

        return new Size(
            max($xs) + 1,
            max($ys) + 1
        );

    }

}
