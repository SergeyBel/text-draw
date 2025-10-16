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
use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;

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



    public function getScreen(): Screen
    {
        $barWidth = $this->style->getBarWidth();
        $unitHeight = $this->style->getUnitHeight();


        $size = new Size($this->calculateWidth($barWidth), $this->calculateHeight($unitHeight));

        $this->drawAxes($size);

        $this->drawLabels($size, $barWidth);

        $this->drawBars($size, $barWidth, $unitHeight);


        return parent::getScreen();
    }

    private function calculateWidth(int $barWidth): int
    {
        $count = count($this->bars);
        return $count * $barWidth + ($count - 1) * $this->style->getGap() + 1;
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
            new Line(
                new Point(0, 0),
                new Point(0, $size->getHeight())
            )->setStyle(new LineStyle()->setChar('|'))
        )->addFigure(
            new Line(
                new Point(0, $size->getHeight())->addX(1),
                new Point($size->getWidth() - 1, $size->getHeight())
            )->setStyle(new LineStyle()->setChar('_'))
        )
        ;
    }

    private function drawLabels(Size $size, int $barWidth): void
    {
        $start = new Point(0, $size->getHeight())->addX(1);

        $labelStyle = new TextStyle()
            ->setWidth($barWidth)
            ->setPaddingChar('_')
            ->setAlign(HorizontalAlign::Center);

        foreach ($this->bars as $bar) {
            $label = new Text($start, $bar->getLabel())->setStyle($labelStyle);
            $this->addFigure($label);
            $start = $start->addX($barWidth + $this->style->getGap());
        }
    }

    private function drawBars(Size $size, int $barWidth, int $unitHeight): void
    {
        $start = new Point(0, $size->getHeight())->addX(1);
        foreach ($this->bars as $bar) {
            $barHeight = $unitHeight * $bar->getValue();
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
