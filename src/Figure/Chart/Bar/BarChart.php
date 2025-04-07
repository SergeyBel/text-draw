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

    public function __construct(
        Size $size,
        ?Point $leftUpperCorner = null
    ) {
        parent::__construct($size, $leftUpperCorner);
    }


    public function addBar(Bar $bar): self
    {
        $this->bars[] = $bar;
        return $this;

    }

    public function draw(): array
    {


        $barWidth = $this->calculateBarWidth();
        $unitHeight = $this->calculateUnitValueHeight();

        $start = new Point(1, $this->getSize()->getHeight() - 1);
        foreach ($this->bars as $bar) {
            $barHeight = $unitHeight * $bar->getValue();
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

    private function calculateBarWidth(): int
    {
        return (int)floor($this->getSize()->getWidth() / count($this->bars)) - 1;
    }

    private function calculateUnitValueHeight(): int
    {
        if (count($this->bars) === 0) {
            return 0;
        }

        $heightWithoutLabel = $this->getSize()->getHeight() - 1;
        return (int) floor($heightWithoutLabel / max(array_map(fn (Bar $bar) => $bar->getValue(), $this->bars)));

    }

}
