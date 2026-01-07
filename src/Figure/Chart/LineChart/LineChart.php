<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\LineChart;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Screen\Screen;

class LineChart implements FigureInterface
{
    private LineChartData $lineChartData;

    private LineChartStyle $style;

    /**
     * @var array<DatasetStyle>
     */
    private array $datasetsStyles = [];

    /**
     * @param array<string> $labels
     */
    public function __construct(
        array $labels
    ) {
        $this->lineChartData = new LineChartData($labels);
        $this->style = new LineChartStyle();

    }

    public function setStyle(LineChartStyle $style): self
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @param array<int|null> $dataset
     * @return $this
     * @throws RenderException
     */
    public function addDataset(array $dataset, ?DatasetStyle $datasetStyle = null): self
    {
        $this->lineChartData = $this->lineChartData->addDataset($dataset);
        $this->datasetsStyles[] = $datasetStyle ?? new DatasetStyle();
        return $this;
    }

    public function draw(): Screen
    {
        return new LineChartDrawer()
            ->draw($this->lineChartData, $this->datasetsStyles, $this->style);
    }
}
