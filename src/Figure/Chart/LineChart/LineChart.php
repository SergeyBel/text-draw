<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\LineChart;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class LineChart extends BaseFigure
{
    /**
     * @var non-empty-array<string>
     */
    private array $labels;

    private LineChartStyle $style;

    /**
     * @var array<array<int|null>>
     */
    private array $datasets = [];

    /**
     * @var array<DatasetStyle>
     */
    private array $datasetsStyles = [];

    /**
     * @var array<int>
     */
    private array $labelsX = [];

    /**
     * @param array<string> $labels
     */
    public function __construct(
        array $labels
    ) {
        if (count($labels) === 0) {
            throw new RenderException('Labels must not be empty');
        }

        $this->labels = $labels;

        $this->style = new LineChartStyle();
        parent::__construct();
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
        if (count($dataset) !== count($this->labels)) {
            throw new RenderException('Dataset must same length as labels');
        }

        $this->datasets[] = $dataset;
        $this->datasetsStyles[] = $datasetStyle ?? new DatasetStyle();
        return $this;
    }

    public function getScreen(): Screen
    {


        $maxValue = $this->getMaxValue();
        $minValue = $this->getMinValue();
        $height = $maxValue - $minValue;


        $this->drawVertical($height);
        $this->drawLabels($height);

        foreach ($this->datasets as $key => $dataset) {
            $this->drawDataset($dataset, $height, $minValue, $this->datasetsStyles[$key]);
        }

        return parent::getScreen();
    }

    /**
     * @param array<int|null> $dataset
     */
    private function drawDataset(array $dataset, int $height, int $minValue, DatasetStyle $style): void
    {
        $previous = null;
        for ($i = 0; $i < count($dataset); $i++) {
            $value = $dataset[$i];
            if (is_null($value)) {
                continue;
            }

            $point = new Point($this->labelsX[$i], $height - $value + $minValue);

            if (is_null($previous)) {
                $previous = $point;
            }

            $lineStyle = new LineStyle()
                ->setChar($style->getLineChar())
            ;

            if (!is_null($style->getPointChar())) {
                $lineStyle
                    ->setStartChar($style->getPointChar())
                    ->setFinishChar($style->getPointChar())
                ;
            }


            $this->addFigure(
                new Line($previous, $point)
                    ->setStyle($lineStyle)
            );

            $previous = $point;
        }

    }

    private function drawVertical(int $height): void
    {
        $this->addFigure(
            new Line(new Point(0, 0), new Point(0, $height))
            ->setStyle(new LineStyle()->setChar('|')),
        );
    }

    private function drawLabels(int $height): void
    {
        $start = new Point(1, $height + 1);
        foreach ($this->labels as $label) {
            $text = new Text($start, $label);
            $this->addFigure($text);
            $this->labelsX[] = $start->getX();
            $start = $start->addX($text->getWidth() + $this->style->getLabelGap());
        }

        $this->addFigure(
            new Line(new Point(0, $height), $text->getStart()->addX($text->getWidth() - 1)->subY(1))
            ->setStyle(new LineStyle()->setChar('-')),
        );

    }

    private function getMaxValue(): int
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

    private function getMinValue(): int
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
