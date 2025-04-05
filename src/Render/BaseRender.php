<?php

declare(strict_types=1);

namespace ConsoleDraw\Render;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class BaseRender
{
    /**
     * @var Pixel[]
     */
    protected array $pixels;
    protected Size $size;

    public function __construct(Size $size)
    {
        $this->size = $size;
    }


    public function setPixel(Pixel $pixel): static
    {
        $this->pixels[] = $pixel;
        return $this;
    }

    /**
     * @param array<Pixel> $pixels
     */
    public function setPixels(array $pixels): static
    {
        foreach ($pixels as $point) {
            $this->setPixel($point);
        }
        return $this;
    }

    public function addFigure(FigureInterface $figure): static
    {
        if ($figure instanceof FrameFigure) {
            if (is_null($figure->getSize())) {
                $figure->setSize($this->size);
            }

            if (is_null($figure->getLeftUpperCorner())) {
                $figure->setLeftUpperCorner(new Point(0, 0));
            }

        }
        return $this->setPixels($figure->draw());
    }
}
