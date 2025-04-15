<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Pixel;

class PixelMatrix
{
    /**
     * @var Pixel[][]
     */
    private array $matrix;

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
        return $this->matrix[$y][$x];
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

}
