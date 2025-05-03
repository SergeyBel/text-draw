<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Chart\Bar;

use ConsoleDraw\Common\Exception\RenderException;
use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Base\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Figure\Geometry\Rechtangle\Rectangle;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Figure\Text\TextStyle;
use ConsoleDraw\Plane\Point;

class BarChart extends BaseFigure
{
    /**
     * @var array<Bar>
     */
    private array $bars;

    private BarChartStyle $style;

    public function __construct(
    ) {
        $this->style = new BarChartStyle();
        parent::__construct();
    }


    public function addBar(Bar $bar): static
    {
        $this->bars[] = $bar;
        return $this;
    }

    public function setStyle(BarChartStyle $style): static
    {
        $this->style = $style;
        return $this;
    }



    public function draw(): PixelMatrix
    {
        $barWidth = $this->style->getBarWidth();
        $unitHeight = $this->style->getUnitHeight();



        $size = new Size($this->calculateWidth($barWidth), $this->calculateHeight($unitHeight));

        $this->drawAxes($size);

        $this->drawLabels($size, $barWidth);

        $this->drawBars($size, $barWidth, $unitHeight);


        return parent::draw();
    }

    private function calculateWidth(int $barWidth): int
    {
        $count = count($this->bars);
        return $count * $barWidth + ($count - 1) * 1 + 1;
    }

    private function calculateHeight(int $unitHeight): int
    {
        if (count($this->bars) === 0) {
            throw new RenderException('No bars');
        }
        return max(array_map(fn (Bar $bar) => $bar->getValue(), $this->bars)) * $unitHeight * 1;
    }


    private function drawAxes(size $size): void
    {
        $this->addFigure(
            (new Line(
                new Point(0, 0),
                new Point(0, $size->getHeight())
            ))->setStyle((new LineStyle())->setSymbol('|'))
        )->addFigure(
            (new Line(
                (new Point(0, $size->getHeight()))->addX(1),
                new Point($size->getWidth() - 1, $size->getHeight())
            ))->setStyle((new LineStyle())->setSymbol('_'))
        )
        ;
    }

    private function drawLabels(Size $size, int $barWidth): void
    {
        $start = (new Point(0, $size->getHeight()))->addX(1);

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

    private function drawBars(Size $size, int $barWidth, int $unitHeight): void
    {
        $start = (new Point(0, $size->getHeight()))->addX(1);
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

}
