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

    public function addBar(Bar $bar): self
    {
        $this->bars[] = $bar;
        return $this;

    }

    public function draw(): array
    {
        if (count($this->bars) === 0) {
            return [];
        }

        $size = $this->getDefinedSize();

        $barCount = count($this->bars);
        $barWidth = (int)floor($size->getWidth() / $barCount) - 1;

        $heightWithoutLabel = $size->getHeight() - 1;

        $unitBarHeight = (int) floor($heightWithoutLabel / max(array_map(fn (Bar $bar) => $bar->getValue(), $this->bars)));

        $start = new Point(1, $size->getHeight() - 1);
        foreach ($this->bars as $bar) {
            $barHeight = $unitBarHeight * $bar->getValue();
            $this->drawBar($start, new Size($barWidth, $barHeight), $bar->getLabel());
            $start = $start->addX($barWidth + 1);
        }

        return parent::draw();
    }

    private function drawBar(Point $leftDownCorner, Size $size, string $label): void
    {
        $this->addFigure(new Text(
            $leftDownCorner,
            $label
        ))->addFigure(new Rectangle(
            $leftDownCorner->subY($size->getHeight()),
            $size
        ));
    }

}
