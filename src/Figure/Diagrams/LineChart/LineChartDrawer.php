<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\LineChart;

use TextDraw\Figure\Elements\Geometry\Line\Line;
use TextDraw\Figure\Elements\Text\Text;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class LineChartDrawer
{
    private Screen $screen;

    /**
     * @var array<int>
     */
    private array $labelsX = [];

    /**
     * @param array<DatasetStyle> $datasetsStyles
     */
    public function draw(
        LineChartData $lineChart,
        array $datasetsStyles,
        LineChartStyle $style
    ): Screen {
        $this->screen = new Screen();

        $minValue = $lineChart->getMinValue();
        $height = $lineChart->getHeight();


        $this->drawVertical($height);
        $this->drawLabels($lineChart->getLabels(), $height, $style);

        foreach ($lineChart->getDatasets() as $key => $dataset) {
            $this->drawDataset($dataset, $height, $minValue, $datasetsStyles[$key]);
        }

        return $this->screen;
    }

    private function drawVertical(int $height): void
    {
        $this->screen = $this->screen->addFigure(
            new Line(new Point(0, 0), new Point(0, $height))
                ->setStyle(new LineStyle()->setChar('|')),
        );
    }

    /**
     * @param non-empty-array<string> $labels
     */
    private function drawLabels(array $labels, int $height, LineChartStyle $style): void
    {
        $start = new Point(1, $height + 1);
        foreach ($labels as $label) {
            $text = new Text($start, $label);
            $this->screen = $this->screen->addFigure($text);
            $this->labelsX[] = $start->getX();
            $start = $start->addX($text->getTextData()->getWidth() + $style->getLabelGap());
        }

        $this->screen = $this->screen->addFigure(
            new Line(new Point(0, $height), $text->getTextData()->getStart()->addX($text->getTextData()->getWidth() - 1)->subY(1))
                ->setStyle(new LineStyle()->setChar('-')),
        );

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
                    ->setEndChar($style->getPointChar())
                ;
            }


            $this->screen = $this->screen->addFigure(
                new Line($previous, $point)
                    ->setStyle($lineStyle)
            );

            $previous = $point;
        }

    }
}
