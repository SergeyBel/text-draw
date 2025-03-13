<?php

namespace ConsoleDraw\Figure\FunctionGraph;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Pixel;

class FunctionGraph extends BaseFigure
{
    /**
     * @var array<FunctionValue>
     */
    private array $values = [];

    private FunctionGraphStyle $style;

    public function __construct(
        private int $width,
        private int $height,
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
        $this
            ->addFigure(
                (new Line(0, 0, 0, $this->height - 1))->setStyle(
                    (new LineStyle())->setSymbol($this->style->getXAxeSymbol())
                )
            )
            ->addFigure(
                (new Line(0, $this->height - 1, $this->width, $this->height - 1))
                    ->setStyle(
                        (new LineStyle())->setSymbol($this->style->getYAxeSymbol())
                    )
            )
            ->addFigure(new Pixel(0, $this->height - 1, $this->style->getZeroSymbol()))
            ->addFigure(new Text(0, 0, $this->style->getYLabel()))
            ->addFigure(new Text($this->width - 1, $this->height - 1, $this->style->getXLabel()))
        ;
    }

    private function drawFunction()
    {

        foreach ($this->values as $value) {
            $x = $value->getX();
            $y = $this->height - 1 - $value->getY();
            $value = new Pixel($x, $y, $this->style->getPointSymbol());
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
