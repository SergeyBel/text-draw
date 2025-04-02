<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Chart\Bar;

use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Geometry\Rechtangle\Rectangle;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class BarChart extends FrameFigure
{
    /**
     * @var array<Bar>
     */
    private array $bars;

    public function draw(): array
    {
        $size = $this->getDefinedSize();

        $barCount = count($this->bars);
        $barWidth = floor(($size->getWidth() - ($barCount - 1)) / $barCount);

        return parent::draw();
    }

    private function drawBar(Point $leftDownCorner, Size $size, string $label)
    {
        $this->addFigure(new Text(
            $leftDownCorner->addY(1),
            $label
        ))->addFigure(new Rectangle(
            $leftDownCorner->subY($size->getHeight()),
            $size
        ));
    }

}
