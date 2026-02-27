<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\LineChart;

use TextDraw\Common\Exception\RenderException;

class LineChartData
{
    /**
     * @var non-empty-array<string>
     */
    private array $labels;

    /**
     * @var array<array<int|null>>
     */
    private array $datasets = [];

    /**
     * @param array<string> $labels
     */
    public function __construct(
        array $labels,
    ) {
        if (count($labels) === 0) {
            throw new RenderException('Labels must not be empty');
        }

        $this->labels = $labels;
    }

    /**
     * @param array<int|null> $dataset
     * @return $this
     * @throws RenderException
     */
    public function addDataset(array $dataset): self
    {
        if (count($dataset) !== count($this->labels)) {
            throw new RenderException('Dataset must same length as labels');
        }

        $that = clone $this;

        $that->datasets[] = $dataset;
        return $that;
    }

    /**
     * @return non-empty-array<string>
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @return array<array<int|null>>
     */
    public function getDatasets(): array
    {
        return $this->datasets;
    }

    public function getHeight(): int
    {
        return $this->getMaxValue() - $this->getMinValue();
    }

    public function getMaxValue(): int
    {
        if (count($this->datasets) === 0) {
            throw new RenderException('Datasets must not be empty');
        }

        $maxes = [];
        foreach ($this->datasets as $dataset) {
            $datasetValues = array_filter($dataset, fn ($value) => !is_null($value));
            if (count($datasetValues) === 0) {
                throw new RenderException('Datasets values must not be empty');
            }
            $maxes[] = max($datasetValues);
        }

        return max($maxes);
    }

    public function getMinValue(): int
    {
        if (count($this->datasets) === 0) {
            throw new RenderException('Datasets must not be empty');
        }

        $mins = [];
        foreach ($this->datasets as $dataset) {
            $datasetValues = array_filter($dataset, fn ($value) => !is_null($value));
            if (count($datasetValues) === 0) {
                throw new RenderException('Datasets values must not be empty');
            }
            $mins[] = min($datasetValues);
        }

        return min($mins);
    }



}
