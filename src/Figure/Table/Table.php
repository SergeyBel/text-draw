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
    /** @var array<array<string|TableCell>>  */
    private array $rows = [];

    private TableStyle $style;

    /**
     * @var array<int>
     */
    private array $cellWidths = [];

    public function __construct(
        Size $size,
        ?Point $leftUpperCorner = null
    ) {
        $this->style = new TableStyle();
        parent::__construct($size, $leftUpperCorner);
    }


    public function draw(): PixelMatrix
    {
        $this->calculateCellWidths();

        $start = $this->getLeftUpperCorner();
        $this->drawRows($start);

        return parent::draw();
    }



    private function drawRows(Point $start): void
    {
        foreach ($this->rows as $row) {
            $this->drawRow($start, $row);
            $start = $start->addY(2);
        }
    }

    /**
     * @param array<string|TableCell> $row
     */
    private function drawRow(Point $start, array $row): void
    {
        foreach ($row as $index => $cell) {
            $this->drawCell($start, $cell, $this->cellWidths[$index]);
            $start = $start->addX($this->cellWidths[$index] + 1);
        }
    }

    private function drawCell(Point $start, string|TableCell $cell, int $cellWidth): void
    {
        $turtle = (new Turtle())
            ->moveTo($start);

        $turtle = $this->drawCellBorder($turtle, $cellWidth);
        $turtle->moveTo($start)->moveDown(1);
        $turtle = $this->drawCellText($turtle, $this->getCellText($cell), $cellWidth);
        $turtle->moveTo($start)->moveDown(2);
        $turtle = $this->drawCellBorder($turtle, $cellWidth);

        $this->addFigure($turtle);
    }

    private function drawCellBorder(Turtle $turtle, int $cellWidth): Turtle
    {
        $turtle
            ->paintRight($this->style->getCrossingSymbol())
            ->paintRight($this->style->getHorizontalSymbol(), $cellWidth)
            ->paint($this->style->getCrossingSymbol())
        ;

        return $turtle;
    }

    private function drawCellText(Turtle $turtle, string $str, int $cellWidth): Turtle
    {
        $text = str_pad($str, $cellWidth, $this->style->getPaddingSymbol());
        $turtle
            ->paintRight($this->style->getVerticalSymbol())
            ->paintText($text)
            ->paint($this->style->getVerticalSymbol());

        return $turtle;
    }

    /**
     * @param array<string> $header
     * @return $this
     */
    public function setHeader(array $header): Table
    {
        $this->rows[] = $header;
        return $this;
    }

    /**
     * @param array<array<string|TableCell>> $rows
     * @return $this
     */
    public function addRows(array $rows): Table
    {
        $this->rows = array_merge($this->rows, $rows);
        return $this;
    }

    private function calculateCellWidths(): void
    {
        $columns = [];
        foreach ($this->rows as $row) {
            foreach ($row as $index => $cell) {
                $columns[$index][] = mb_strlen($this->getCellText($cell));
            }
        }

        foreach ($columns as $index => $column) {
            $this->cellWidths[$index] = max($column);
        }

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
