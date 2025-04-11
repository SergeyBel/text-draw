<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Table;

use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Figure\Turtle\Turtle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class Table extends FrameFigure
{
    /** @var array<string>  */
    private array $header = [];

    /** @var array<array<string|TableCell>>  */
    private array $rows = [];

    private TableStyle $style;

    public function __construct(
        Size $size,
        ?Point $leftUpperCorner = null
    ) {
        $this->style = new TableStyle();
        parent::__construct($size, $leftUpperCorner);
    }


    public function draw(): PixelMatrix
    {
        $cellWidth = $this->calculateCellWidth();
        $cellCount = $this->calculateCellCount();
        $start = $this->getLeftUpperCorner();

        $start = $this->drawHeader($start, $cellCount, $cellWidth);
        $this->drawRows($start, $cellCount, $cellWidth);

        return parent::draw();
    }

    private function drawHeader(Point $start, int $cellCount, int $cellWidth): Point
    {
        $this->drawSeparator($start, $cellCount, $cellWidth);
        $start = $start->addY(1);

        if (count($this->header) === 0) {
            return $start;
        }
        $this->drawRow($start, $this->header, $cellWidth);
        $start = $start->addY(1);
        $this->drawSeparator($start, $cellCount, $cellWidth);
        $start = $start->addY(1);

        return $start;
    }

    private function drawRows(Point $start, int $cellCount, int $cellWidth): void
    {
        foreach ($this->rows as $row) {
            $this->drawRow($start, $row, $cellWidth);
            $start = $start->addY(1);
            $this->drawSeparator($start, $cellCount, $cellWidth);
            $start = $start->addY(1);
        }
    }

    /**
     * @param array<string> $row
     */
    private function drawRow(Point $start, array $row, int $cellWidth): void
    {
        $turtle = (new Turtle())
            ->moveTo($start)
            ->paintRight($this->style->getVerticalSymbol());


        foreach ($row as $cell) {
            $str = $this->getCellText($cell);
            $text = str_pad($str, $cellWidth, $this->style->getPaddingSymbol());
            $turtle
                ->paintText($text)
                ->paintRight($this->style->getVerticalSymbol());
        }

        $this->addFigure($turtle);
    }

    /**
     * @return array<string>
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @param array<string> $header
     * @return $this
     */
    public function setHeader(array $header): Table
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @return array<array<string>>
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * @param array<array<string|TableCell>> $rows
     * @return $this
     */
    public function setRows(array $rows): Table
    {
        $this->rows = $rows;
        return $this;
    }

    private function drawSeparator(Point $start, int $cellCount, int $cellWidth): void
    {
        $turtle = (new Turtle())
            ->moveTo($start)
            ->paintRight($this->style->getCrossingSymbol());

        for ($i = 0; $i < $cellCount; $i++) {
            $turtle
                ->paintRight($this->style->getHorizontalSymbol(), $cellWidth)
                ->paintRight($this->style->getCrossingSymbol());
        }

        $this->addFigure($turtle);
    }

    private function calculateCellCount(): int
    {
        if (count($this->header) > 0) {
            return count($this->header);
        }

        return max(array_map(fn ($row) => count($row), $this->rows));
    }

    private function calculateCellWidth(): int
    {
        if (!is_null($this->style->getColumnWidth())) {
            return $this->style->getColumnWidth();
        }

        $max = 0;
        foreach ($this->rows as $row) {
            foreach ($row as $cell) {
                $length = mb_strlen($this->getCellText($cell));
                if ($length > $max) {
                    $max = $length;
                }
            }
        }

        return $max;
    }

    private function getCellText(string | TableCell $cell): string
    {
        if ($cell instanceof TableCell) {
            return $cell->text;
        } else {
            return $cell;
        }
    }


}
