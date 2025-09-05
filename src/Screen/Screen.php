<?php

declare(strict_types=1);

namespace TextDraw\Screen;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Common\Size;
use TextDraw\Figure\Base\FigureInterface;
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
        $this->setPixels($pixels);
    }


    public function addFigure(FigureInterface $figure): self
    {

        $this->merge($figure->draw());
        return $this;
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

    public function merge(Screen $screen): static
    {
        $this->setPixels($screen->getPixels());
        return $this;
    }


    public function clear(): static
    {
        $this->matrix = [];
        return $this;
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

    public function move(int $deltaX, int $deltaY): self
    {
        $pixels = $this->getPixels();
        foreach ($pixels as $pixel) {
            $pixel->setPoint(
                $pixel->getPoint()
                    ->addX($deltaX)
                    ->addY($deltaY)
            );
        }
        return $this->setPixels($pixels);
    }

    public function rotate(): self
    {
        $size = $this->getSize();
        $newPixels = [];

        foreach ($this->getPixels() as $pixel) {
            $x = $pixel->getPoint()->getX();
            $y = $pixel->getPoint()->getY();

            $newPoint = clone $pixel->getPoint();

            $newPoint
                ->setX($size->getHeight() - $y - 1)
                ->setY($x);
            $newPixels[] = new Pixel(
                $newPoint,
                $pixel->getChar()
            );
        }
        $this->clear()->setPixels($newPixels);
        return $this;

    }


}
