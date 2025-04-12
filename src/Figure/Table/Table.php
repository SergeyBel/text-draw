<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Table;

use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Figure\Text\TextStyle;
use ConsoleDraw\Figure\Turtle\Turtle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class Table extends FrameFigure
{
    /** @var array<array<TableCell>>  */
    private array $rows = [];

    private TableStyle $style;

    /**
     * @var array<int>
     */
    private array $columnsWidth = [];

    public function __construct(
        Size $size,
        ?Point $leftUpperCorner = null
    ) {
        $this->style = new TableStyle();
        parent::__construct($size, $leftUpperCorner);
    }


    public function draw(): PixelMatrix
    {
        //$this->fillRows();
        $this->calculateColumnsWidth();

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
     * @param array<TableCell> $row
     */
    private function drawRow(Point $start, array $row): void
    {
        foreach ($row as $columnIndex => $cell) {
            $this->drawCell($start, $cell, $columnIndex);
            $start = $start->addX($this->columnsWidth[$columnIndex] + 1);
        }
    }

    private function drawCell(Point $start, TableCell $cell, int $columnIndex): void
    {
        $cellWidth = $this->columnsWidth[$columnIndex];

        $turtle = (new Turtle())
            ->moveTo($start);

        $turtle = $this->drawCellBorder($turtle, $cellWidth);
        $turtle->moveTo($start)->moveDown(1);
        $turtle = $this->drawCellText($turtle, $cell, $cellWidth);
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

    private function drawCellText(Turtle $turtle, TableCell $cell, int $cellWidth): Turtle
    {
        $turtle
            ->paintRight($cell->getLeftChar() ?? $this->style->getVerticalSymbol());

        $text = new Text($turtle->getPosition(), $cell->getText());
        $text->setStyle(
            (new TextStyle())
                ->setWidth($cellWidth)
                ->setPaddingChar($this->style->getPaddingSymbol())
        );
        $this->addFigure($text);

        $turtle
            ->moveRight($cellWidth)
            ->paint($this->style->getVerticalSymbol());

        return $turtle;
    }

    /**
     * @param array<string> $header
     * @return $this
     */
    public function setHeader(array $header): Table
    {
        $this->addRow($header);
        return $this;
    }

    /**
     * @param array<array<string|TableCell>> $rows
     * @return $this
     */
    public function addRows(array $rows): Table
    {
        foreach ($rows as $row) {
            $this->addRow($row);
        }

        return $this;
    }

    /**
     * @param array<string|TableCell> $row
     */
    public function addRow(array $row): self
    {
        $row = array_map(fn ($cell) => is_string($cell) ? new TableCell($cell) : $cell, $row);

        $fullRow = [];
        foreach ($row as $cell) {
            if ($cell->getColspan() === 1) {
                $fullRow[] = $cell;
                continue;
            }
            $colspan = $cell->getColspan();

            $fullRow[] = $cell->setColspan(1);
            $emptyCell = (new TableCell($this->style->getPaddingSymbol()))->setLeftChar($this->style->getPaddingSymbol());
            $fullRow = array_merge(
                $fullRow,
                array_fill(0, $colspan - 1, $emptyCell)
            );

        }
        $this->rows[] = $fullRow;
        return $this;

    }

    public function getStyle(): TableStyle
    {
        return $this->style;
    }

    public function setStyle(TableStyle $style): Table
    {
        $this->style = $style;
        return $this;
    }


    private function calculateColumnsWidth(): void
    {
        $columns = [];
        foreach ($this->rows as $row) {
            foreach ($row as $index => $cell) {
                $columns[$index][] = mb_strlen($cell->getText());
            }
        }

        foreach ($columns as $index => $column) {
            $width = max($column);
            if (!is_null($this->style->getColumnMaxWidth())) {
                $width = min($width, $this->style->getColumnMaxWidth());
            }
            $this->columnsWidth[$index] = $width;
        }

    }
}
