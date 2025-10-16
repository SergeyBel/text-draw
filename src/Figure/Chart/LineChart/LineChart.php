<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\LineChart;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Common\Size;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class LineChart extends BaseFigure
{

    private LineChartStyle $style;

    private array $datasets = [];

    private array $labelsX = [];

    public function __construct(
        private array $labels
    ) {
        $this->style = new LineChartStyle();
        parent::__construct();
    }

    public function setStyle(LineChartStyle $style): self
    {
        $this->style = $style;
        return $this;
    }

    public function addDataset(array $dataset): self
    {
        if (count($dataset) !== count($this->labels)) {
            throw new RenderException('Dataset must same length as labels');
        }

        $this->datasets[] = $dataset;
        return $this;
    }

    public function getScreen(): Screen
    {
        $maxValue = $this->getMaxValue();
        $minValue = $this->getMinValue();
        $height = $maxValue - $minValue;

        $this->drawVertical($height);
        $this->drawLabels($height);

        foreach ($this->datasets as $dataset) {
            $this->drawDataset($dataset, $height, $minValue);
        }

        return parent::getScreen();
    }

    private function drawDataset(array $dataset, int $height, int $minValue): void
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

            $this->addFigure(
                new Line($previous, $point)
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
            $start = $start->addX($text->getWidth() + 2);
        }

        $this->addFigure(
            new Line(new Point(0, $height), $text->getStart()->addX($text->getWidth() - 1)->subY(1))
            ->setStyle(new LineStyle()->setChar('-')),
        );

    }

    private function getMaxValue(): int
    {
        $maxes = [];
        foreach ($this->datasets as $dataset) {
            $maxes[] = max($dataset);
        }

        return max($maxes);
    }

    private function getMinValue(): int
    {
        $mins = [];
        foreach ($this->datasets as $dataset) {
            $mins[] = min($dataset);
        }

        return min($mins);
    }



}
