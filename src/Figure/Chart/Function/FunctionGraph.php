<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Chart\Function;

use ConsoleDraw\Common\Exception\RenderException;
use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Base\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Point;

class FunctionGraph extends BaseFigure
{
    /**
     * @var array<FunctionValue>
     */
    private array $values = [];

    private FunctionGraphStyle $style;

    public function __construct(
    ) {
        $this->style = new FunctionGraphStyle();
        parent::__construct();

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
     */
    public function setValues(array $values): static
    {
        $this->values = $values;
        return $this;
    }

    public function addValue(FunctionValue $value): static
    {
        $this->values[] = $value;
        return $this;
    }

    public function draw(): PixelMatrix
    {
        if (count($this->values) === 0) {
            throw new RenderException('No values');
        }
        $maxX = max(array_map(fn (FunctionValue $value) => $value->getX(), $this->values));
        $minX = min(array_map(fn (FunctionValue $value) => $value->getX(), $this->values));

        $maxY = max(array_map(fn (FunctionValue $value) => $value->getY(), $this->values));
        $minY = min(array_map(fn (FunctionValue $value) => $value->getY(), $this->values));

        $size = new Size($maxX - $minX + 1, $maxY - $minY + 1);

        $this->drawAxes($size);
        $this->drawFunction($size);

        return parent::draw();
    }

    private function drawFunction(Size $size): void
    {
        $maxY = $size->getHeight() - 1;
        foreach ($this->values as $value) {
            $x = $value->getX();
            $y = $maxY - $value->getY();
            $value = new Pixel(new Point($x, $y), $this->style->getPointSymbol());
            $this->addFigure($value);
        }
    }


    private function drawAxes(Size $size): void
    {
        $width = $size->getWidth();
        $height = $size->getHeight();

        $highYPoint = new Point(0, 0);
        $zeroPoint = $highYPoint->addHeight($height);
        $highXPoint = $zeroPoint->addWidth($width);

        $this
            ->addFigure(
                (new Line($zeroPoint, $highYPoint))
                    ->setStyle(
                        (new LineStyle())->setSymbol('|')
                    )
            )
            ->addFigure(
                (new Line($zeroPoint, $highXPoint))->setStyle(
                    (new LineStyle())->setSymbol('-')
                )
            )
            ->addFigure(new Pixel($zeroPoint, $this->style->getZeroSymbol()))
        ;
    }


}
