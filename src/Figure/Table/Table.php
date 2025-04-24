<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Table;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Figure\Text\TextStyle;
use ConsoleDraw\Figure\Turtle\Turtle;
use ConsoleDraw\Plane\Point;

class Table extends BaseFigure
{
    /** @var array<string|TableCell>  */
    private array $header = [];

    /** @var array<array<string|TableCell>>  */
    private array $rows = [];

    /** @var array<array<TableCell>>  */
    private array $table;

    private TableStyle $style;

    /**
     * @var array<int>
     */
    private array $columnsWidth = [];

    private Point $leftUpperCorner;


    public function __construct(
        ?Point $leftUpperCorner = null
    ) {
        if (!is_null($leftUpperCorner)) {
            $this->leftUpperCorner = $leftUpperCorner;
        } else {
            $this->leftUpperCorner = new Point(0, 0);
        }
        $this->style = new TableStyle();

        parent::__construct();
    }


    public function draw(): PixelMatrix
    {
        $this->formTable();
        $this->calculateColumnsWidth();

        $start = $this->leftUpperCorner;
        $this->drawTable($start);

        return parent::draw();
    }

    /**
     * @param array<string|TableCell> $header
     */
    public function setHeader(array $header): static
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param array<array<string|TableCell>> $rows
     */
    public function addRows(array $rows): static
    {
        $this->rows = array_merge($this->rows, $rows);
        return $this;
    }

    public function getStyle(): TableStyle
    {
        return $this->style;
    }

    public function setStyle(TableStyle $style): static
    {
        $this->style = $style;
        return $this;
    }



    private function drawTable(Point $start): void
    {
        foreach ($this->table as $row) {
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
            ->paintRight($this->style->getCrossingChar())
            ->paintRight($this->style->getHorizontalChar(), $cellWidth)
            ->paint($this->style->getCrossingChar())
        ;

        return $turtle;
    }

    private function drawCellText(Turtle $turtle, TableCell $cell, int $cellWidth): Turtle
    {
        $turtle
            ->paintRight($cell->getLeftChar() ?? $this->style->getVerticalChar());

        $text = new Text($turtle->getPosition(), $cell->getText());
        $text->setStyle(
            (new TextStyle())
                ->setWidth($cellWidth)
                ->setPaddingChar($this->style->getPaddingChar())
                ->setAlign($cell->getAlign())
        );
        $this->addFigure($text);

        $turtle
            ->moveRight($cellWidth)
            ->paint($this->style->getVerticalChar());

        return $turtle;
    }

    private function formTable(): void
    {
        if (count($this->header) > 0) {
            $header = array_map(fn ($cell) =>
            is_string($cell)
                ? new TableCell($cell, align: $this->style->getHeaderAlign())
                : $cell, $this->header);
            $this->table[] = $header;
        }

        foreach ($this->rows as $row) {
            $this->formTableRow($row);
        }
    }

    /**
     * @param array<string|TableCell> $row
     */
    private function formTableRow(array $row): void
    {
        $row = array_map(fn ($cell) => is_string($cell) ? new TableCell($cell, align: $this->style->getAlign()) : $cell, $row);

        $fullRow = [];
        foreach ($row as $cell) {
            if ($cell->getColspan() === 1) {
                $fullRow[] = $cell;
                continue;
            }
            $colspan = $cell->getColspan();

            $fullRow[] = $cell->setColspan(1);
            $emptyCell = (new TableCell($this->style->getPaddingChar()))->setLeftChar($this->style->getPaddingChar());
            $fullRow = array_merge(
                $fullRow,
                array_fill(0, $colspan - 1, $emptyCell)
            );

        }

        $this->table[] = $fullRow;
    }

    private function calculateColumnsWidth(): void
    {
        $columns = [];
        foreach ($this->table as $row) {
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
