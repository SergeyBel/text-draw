<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Common\Size;
use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Screen\Screen;

class BarChart implements FigureInterface
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

        $groups = [];
        for ($i = 0; $i < count($this->labels); $i++) {
            $column = array_column($this->datasets, $i);
            $group = [];
            foreach ($column as $value) {
                $group[] = new Bar($value, new Size($barWidth, $value * $unitHeight));
            }
            $groups[] = new BarGroup($this->labels[$i], $group);
        }

        $barChartData = new BarChartData(
            $groups,
            $size,
        );

        return new BarChartDrawer()->draw(
            $barChartData,
            $this->datasetsStyles,
            $this->style
        );

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
}
