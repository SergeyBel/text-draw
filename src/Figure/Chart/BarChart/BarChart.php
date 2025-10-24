<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

use TextDraw\Common\Size;
use TextDraw\Common\HorizontalAlign;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Geometry\Rectangle\Rectangle;
use TextDraw\Figure\Text\Text;
use TextDraw\Figure\Text\TextStyle;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;
use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;

class BarChart extends BaseFigure
{
    private array $labels;

    private array $datasets;

    private BarChartStyle $style;

    public function __construct(
    ) {
        $this->style = new BarChartStyle();
        parent::__construct();
    }

    public function setLabels(array $labels): self
    {
        $this->labels = $labels;
        return $this;
    }

    public function addDataset(array $dataset): self
    {
        $this->datasets[] = $dataset;
        return $this;
    }


    public function setStyle(BarChartStyle $style): static
    {
        $this->style = $style;
        return $this;
    }


    public function getScreen(): Screen
    {
        $barWidth = $this->style->getBarWidth();
        $unitHeight = $this->style->getUnitHeight();

        $size = new Size($this->calculateWidth($barWidth), $this->calculateHeight($unitHeight));

        $this->drawAxes($size);

        $labelWidth = $barWidth;
        $this->drawLabels($size, $labelWidth);

        foreach ($this->datasets as $index => $dataset) {
            $this->drawDataset($size, $dataset, $index, $barWidth, $unitHeight);
        }

        return parent::getScreen();
    }

    private function calculateWidth(int $barWidth): int
    {
        $labels = count($this->labels);
        $bars = count($this->datasets);
        $gaps = ($labels - 1) * $this->style->getGap();

        return $labels * $bars * $barWidth + $gaps;
    }

    private function calculateHeight(int $unitHeight): int
    {
        foreach ($this->datasets as $dataset) {
            $maxes[] = max($dataset);
        }
        return max($maxes) * $unitHeight + 1;
    }


    private function drawAxes(size $size): void
    {
        $this->addFigure(
            new Line(
                new Point(0, 0),
                new Point(0, 0)->addHeight($size->getHeight()),
            )->setStyle(new LineStyle()->setChar('|'))
        )
        ;
    }

    private function drawLabels(Size $size, int $labelWidth): void
    {
        $start = new Point(0, 0)->addHeight($size->getHeight())->addX(1);

        $labelStyle = new TextStyle()
            ->setAlign(HorizontalAlign::Center);


        foreach ($this->labels as $label) {
            $text = new Text($start, $label, $labelWidth)->setStyle($labelStyle);
            $this->addFigure($text);
            $start = $start->addX($labelWidth + $this->style->getGap());
        }
    }

    private function drawDataset(
        Size $size,
        array $dataset,
        int $index,
        int $barWidth,
        int $unitHeight,
    ): void {
        $start = new Point(0, 0)->addHeight($size->getHeight())->addX(1);
        foreach ($dataset as $value) {
            $barHeight = $unitHeight * $value;
            $this->drawBar($start, new Size($barWidth, $barHeight));
            $start = $start->addX($barWidth + $this->style->getGap());
        }
    }

    private function drawBar(Point $leftDownCorner, Size $size): void
    {
        $style = new RectangleStyle()
                        ->setVerticalChar($this->style->getVerticalChar())
                    ->setHorizontalChar($this->style->getHorizontalChar())
                    ->setCrossingChar($this->style->getCrossingChar())
        ;

        $this->addFigure(
            new Rectangle(
                $leftDownCorner->subY($size->getHeight()),
                $size
            )->setStyle($style)
        );
    }
}
