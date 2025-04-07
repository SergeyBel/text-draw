<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\FunctionGraph;

use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Geometry\Arrow\Arrow;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class FunctionGraph extends FrameFigure
{
    /**
     * @var array<FunctionValue>
     */
    private array $values = [];

    private FunctionGraphStyle $style;

    public function __construct(
        Size $size,
        ?Point $leftUpperCorner = null
    ) {
        $this->style = new FunctionGraphStyle();
        parent::__construct($size, $leftUpperCorner);
    }

    public function draw(): array
    {
        $this->drawAxes();
        $this->drawFunction();

        return parent::draw();
    }

    /**
     * @return FunctionValue[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @param array<FunctionValue> $values
     * @return $this
     */
    public function setValues(array $values): FunctionGraph
    {
        $this->values = $values;
        return $this;
    }

    public function addValue(FunctionValue $value): FunctionGraph
    {
        $this->values[] = $value;
        return $this;
    }


    private function drawAxes(): void
    {
        $width = $this->getSize()->getWidth();
        $height = $this->getSize()->getHeight();
        $zeroPoint = $this->getLeftUpperCorner()->addHeight($height);
        $highYPoint = clone $this->getLeftUpperCorner();
        $highXPoint = $zeroPoint->addWidth($width);

        $this
            ->addFigure(
                new Arrow($zeroPoint, $highYPoint)
            )
            ->addFigure(
                new Arrow($zeroPoint, $highXPoint)
            )
            ->addFigure(new Pixel($zeroPoint, $this->style->getZeroSymbol()))
        ;
    }

    private function drawFunction(): void
    {
        foreach ($this->values as $value) {
            $x = $value->getX();
            $y = $this->getSize()->getHeight() - 1 - $value->getY();
            $value = new Pixel(new Point($x, $y), $this->style->getPointSymbol());
            $this->addFigure($value);
        }
    }
}
