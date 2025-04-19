<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Chart\Bar;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Figure\Geometry\Rechtangle\Rectangle;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Figure\Text\TextStyle;
use ConsoleDraw\Plane\Point;

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

    public function draw(): PixelMatrix
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

    public function addBar(Bar $bar): static
    {
        $this->bars[] = $bar;
        return $this;

    }

    private function drawAxes(): void
    {
        $this->addFigure(
            (new Line(
                $this->leftUpperCorner,
                $this->leftUpperCorner->addHeight($this->size->getHeight())
            ))->setStyle((new LineStyle())->setSymbol('|'))
        )->addFigure(
            (new Line(
                $this->leftUpperCorner->addHeight($this->size->getHeight())->addX(1),
                $this->leftUpperCorner->addHeight($this->size->getHeight())->addWidth($this->size->getWidth())
            ))->setStyle((new LineStyle())->setSymbol('_'))
        )
        ;
    }

    private function drawLabels(Point $start, Size $area): void
    {
        $barWidth = $this->calculateBarWidth($area);
        $labelStyle = (new TextStyle())
            ->setWidth($barWidth)
            ->setPaddingChar('_')
            ->alignCenter();

        foreach ($this->bars as $bar) {
            $label = (new Text($start, $bar->getLabel()))->setStyle($labelStyle);
            $this->addFigure($label);
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
