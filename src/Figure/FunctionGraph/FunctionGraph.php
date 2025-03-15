<?php

namespace ConsoleDraw\Figure\FunctionGraph;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Plane\Point;

class FunctionGraph extends FrameFigure
{
    /**
     * @var array<FunctionValue>
     */
    private array $values = [];

    private FunctionGraphStyle $style;

    public function __construct(
    ) {
        $this->style = new FunctionGraphStyle();
    }

    public function draw(): array
    {
        $this->drawAxes();
        $this->drawFunction();

        return parent::draw();
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function setValues(array $values): FunctionGraph
    {
        $this->values = $values;
        return $this;
    }

    private function drawAxes()
    {
        $width = $this->getSize()->getWidth();
        $height = $this->getSize()->getHeight();
        $zeroPoint = $this->getLeftUpperCorner()->addHeight($height);
        $highYPoint = clone $this->leftUpperCorner;
        $highXPoint = $zeroPoint->addWidth($width);

        $this
            ->addFigure(
                (new Line($zeroPoint, $highYPoint))->setStyle(
                    (new LineStyle())->setSymbol($this->style->getXAxeSymbol())
                )
            )
            ->addFigure(
                (new Line($zeroPoint, $highXPoint))
                    ->setStyle(
                        (new LineStyle())->setSymbol($this->style->getYAxeSymbol())
                    )
            )
            ->addFigure(new Pixel($zeroPoint, $this->style->getZeroSymbol()))
            ->addFigure(new Text($highYPoint, $this->style->getYLabel()))
            ->addFigure(new Text($highXPoint, $this->style->getXLabel()))
        ;
    }

    private function drawFunction()
    {
        foreach ($this->values as $value) {
            $x = $value->getX();
            $y = $this->getSize()->getHeight()- 1 - $value->getY();
            $value = new Pixel(new Point($x, $y), $this->style->getPointSymbol());
            $this->addFigure($value);
        }
    }

    public function getStyle(): FunctionGraphStyle
    {
        return $this->style;
    }

    public function setStyle(FunctionGraphStyle $style): FunctionGraph
    {
        $this->style = $style;
        return $this;
    }

}
