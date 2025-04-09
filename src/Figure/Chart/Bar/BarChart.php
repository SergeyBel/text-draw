<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Chart\Bar;

use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
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
        $this->drawAxes();
        $area = $this->size
                    ->subWidth(2)
                    ->subHeight(1);

        $this->drawLabels($this->leftUpperCorner->addX(2)->addY($area->getHeight()), $area);

        $this->drawBars(
            $area,
            $this->leftUpperCorner->addX(2)->addY($area->getHeight())
        );


        return parent::draw();
    }

    private function drawAxes(): void
    {
        $height = $this->size->getHeight() - 1;
        $width = $this->size->getWidth() - 1;
        $this->addFigure(
            (new Line(
                $this->leftUpperCorner,
                $this->leftUpperCorner->addY($height)
            ))->setStyle((new LineStyle())->setSymbol('|'))
        )->addFigure(
            (new Line(
                $this->leftUpperCorner->addY($height)->addX(1),
                $this->leftUpperCorner->addY($height)->addX($width)
            ))->setStyle((new LineStyle())->setSymbol('_'))
        )
        ;
    }

    private function drawLabels(Point $start, Size $area): void
    {
        $barWidth = $this->calculateBarWidth($area);

        foreach ($this->bars as $bar) {
            $this->addFigure(new Text($start, $bar->getLabel()));
            $start = $start->addX($barWidth + 1);
        }
    }

    private function drawBars(Size $area, Point $start): void
    {
        $barWidth = $this->calculateBarWidth($area);
        $unitHeight = $this->calculateUnitValueHeight($area);



        foreach ($this->bars as $bar) {
            $barHeight = $unitHeight * $bar->getValue();
            $this->drawBar($start, new Size($barWidth, $barHeight));
            $start = $start->addX($barWidth + 1);
        }
    }

    private function drawBar(Point $leftDownCorner, Size $size): void
    {
        $this->addFigure(new Rectangle(
            $leftDownCorner->subY($size->getHeight()),
            $size
        ));
    }

    private function calculateBarWidth(Size $size): int
    {
        return (int)floor($size->getWidth() / count($this->bars));
    }

    private function calculateUnitValueHeight(Size $size): int
    {
        if (count($this->bars) === 0) {
            return 0;
        }

        return (int) floor($size->getHeight() / max(array_map(fn (Bar $bar) => $bar->getValue(), $this->bars)));

    }

}
