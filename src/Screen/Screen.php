<?php

declare(strict_types=1);

namespace TextDraw\Screen;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Common\Size;
use TextDraw\Figure\Pixel\Pixel;
use Exception;

class Screen
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
        foreach ($pixels as $pixel) {
            $this->matrix[$pixel->getPoint()->getY()][$pixel->getPoint()->getX()] = $pixel;
        }
    }


    public function setPixel(Pixel $pixel): self
    {
        $that = clone $this;

        $that->matrix[$pixel->getPoint()->getY()][$pixel->getPoint()->getX()] = $pixel;
        return $that;
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

    public function merge(Screen $screen): self
    {
        return $this->setPixels($screen->getPixels());
    }


    public function clear(): self
    {
        return new self([]);
    }

    public function getSize(): Size
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

    /**
     * @param array<Pixel> $pixels
     * @return $this
     */
    public function setPixels(array $pixels): self
    {
        $that = clone $this;

        foreach ($pixels as $pixel) {
            $that->matrix[$pixel->getPoint()->getY()][$pixel->getPoint()->getX()] = $pixel;
        }

        return $that;
    }

}
