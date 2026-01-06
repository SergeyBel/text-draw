<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

use TextDraw\Common\Exception\RenderException;
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

class BarChart extends BaseFigure
{
    /**
     * @var non-empty-array<string>
     */
    private array $labels;

    /**
     * @var array<array<int>>
     */
    private array $datasets = [];

    /**
     * @var array<DatasetStyle>
     */
    private array $datasetsStyles = [];

    private BarChartStyle $style;

    /**
     * @param array<string> $labels
     * @throws RenderException
     */
    public function __construct(
        array $labels
    ) {
        if (count($labels) === 0) {
            throw new RenderException('Labels must not be empty');
        }

        $this->labels = $labels;

        $this->style = new BarChartStyle();
        parent::__construct();
    }


    /**
     * @param array<int> $dataset
     * @return $this
     */
    public function addDataset(array $dataset, ?DatasetStyle $style = null): self
    {
        if (count($dataset) !== count($this->labels)) {
            throw new RenderException('Dataset and labels count mismatch');
        }
        $this->datasets[] = $dataset;


        $this->datasetsStyles[] = $style ?? new DatasetStyle();

        return $this;
    }


    public function setStyle(BarChartStyle $style): static
    {
        $this->style = $style;
        return $this;
    }


    public function draw(): Screen
    {
        $barWidth = $this->style->getBarWidth();
        $unitHeight = $this->style->getUnitHeight();

        $size = new Size($this->calculateWidth($barWidth), $this->calculateHeight($unitHeight));

        $this->drawAxes($size);

        $this->drawLabels($size, $barWidth * count($this->datasets));

        foreach ($this->datasets as $index => $dataset) {
            $this->drawDataset($size, $dataset, $index, $barWidth, $unitHeight);
        }

        return parent::draw();
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
        $maxes = [];
        foreach ($this->datasets as $dataset) {
            if (count($dataset) === 0) {
                throw new RenderException('Dataset empty');
            }
            $maxes[] = max($dataset);
        }
        if (count($maxes) == 0) {
            throw new RenderException('Datasets empty');
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

    /**
     * @param array<int> $dataset
     */
    private function drawDataset(
        Size $size,
        array $dataset,
        int $index,
        int $barWidth,
        int $unitHeight,
    ): void {
        $labelWidth = $barWidth * count($this->datasets);
        $shift = $labelWidth + $this->style->getGap();

        $start = new Point(0, 0)
                    ->addHeight($size->getHeight())
                    ->addX(1)
                    ->addX($barWidth * $index);

        foreach ($dataset as $value) {
            $barHeight = $unitHeight * $value;
            $this->drawBar($start, new Size($barWidth, $barHeight), $this->datasetsStyles[$index]);
            $start = $start->addX($shift);
        }
    }

    private function drawBar(Point $leftDownCorner, Size $size, DatasetStyle $style): void
    {

        $this->addFigure(
            new Rectangle(
                $leftDownCorner->subY($size->getHeight()),
                $size
            )->setStyle($style->getBarStyle())
        );
    }
}
