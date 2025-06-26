<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Figure\Table\TableBag\TableBag;
use TextDraw\Figure\Table\TableBag\TableElement;
use TextDraw\Figure\Text\Text;
use TextDraw\Figure\Text\TextStyle;
use TextDraw\Figure\Turtle\Turtle;
use TextDraw\Plane\Point;

class Table extends BaseFigure
{
    private TableStyle $style;

    private TableBag $table;

    public function __construct(
    ) {
        $this->style = new TableStyle();
        $this->table = new TableBag();
        parent::__construct();
    }

    /**
     * @param array<string|TableCell> $header
     */
    public function setHeader(array $header): static
    {
        foreach ($header as $key => $cell) {
            if (is_string($cell)) {
                $header[$key] = new TableCell($cell, align: $this->style->getHeaderAlign());
            }

        }
        $this->table->addRow($header);
        return $this;
    }

    /**
     * @param array<array<string|TableCell>> $rows
     */
    public function addRows(array $rows): static
    {
        foreach ($rows as $row) {
            foreach ($row as $key => $cell) {
                if (is_string($cell)) {
                    $row[$key] = new TableCell($cell, align: $this->style->getAlign());
                }
            }
            $this->table->addRow($row);
        }
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


    public function draw(): PixelMatrix
    {
        //$this->formTable();
        //$this->calculateColumnsWidth();

        $start = new Point(0, 0);
        $this->drawTable($start);

        return parent::draw();
    }

    private function drawTable(Point $start): void
    {
        foreach ($this->table->getRows() as $row) {
            $this->drawRow($start, $row);
            $start = $start->addY(2);
        }
    }

    /**
     * @param array<TableElement> $row
     */
    private function drawRow(Point $start, array $row): void
    {
        foreach ($row as $element) {
            $this->drawElement($start, $element);
            $start = $start->addX($element->getWidth() + 1);
        }
    }

    private function drawElement(Point $start, TableElement $element): void
    {

        $turtle = new Turtle()
            ->moveTo($start);

        $turtle = $this->drawElementBorder($turtle, $element);
        $turtle->moveTo($start)->moveDown(1);
        $turtle = $this->drawElementText($turtle, $element);
        $turtle->moveTo($start)->moveDown(2);
        $turtle = $this->drawElementBorder($turtle, $element);

        $this->addFigure($turtle);
    }

    private function drawElementBorder(Turtle $turtle, TableElement $element): Turtle
    {
        $turtle
            ->paintRight($this->style->getCrossingChar())
            ->paintRight($this->style->getHorizontalChar(), $element->getWidth())
            ->paint($this->style->getCrossingChar())
        ;

        return $turtle;
    }

    private function drawElementText(Turtle $turtle, TableElement $element): Turtle
    {
        $turtle->paintRight($this->style->getVerticalChar());

        $text = Text::fromTextFrame($turtle->getPosition(), $element->getTextFrame());
        $this->addFigure($text);

        $turtle
            ->moveRight($element->getWidth())
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
            $this->table_pld[] = $header;
        }

        foreach ($this->rows as $row) {
            $this->formTableRow($row);
        }
    }

    /**
     * @param array<string|TableCell> $row
     */
    /*private function formTableRow(array $row): void
    {
        $row = array_map(fn ($cell) => is_string($cell) ?
            new TableCell($cell, align: $this->style->getAlign())
            : $cell, $row);

        $fullRow = [];
        foreach ($row as $cell) {
            if ($cell->getColspan() === 1) {
                $fullRow[] = $cell;
                continue;
            }
            $colspan = $cell->getColspan();

            $fullRow[] = $cell->setColspan(1);
            $emptyCell = TableCell::createEmpty($this->style);
            $fullRow = array_merge(
                $fullRow,
                array_fill(0, $colspan, $emptyCell)
            );

            $fullRow[] = $cell;
        }

        $this->table_pld[] = $fullRow;
    }*/

    /*private function calculateColumnsWidth(): void
    {
        $columns = [];
        foreach ($this->table_pld as $row) {
            foreach ($row as $index => $cell) {
                $columns[$index][] = $cell->getLength();
            }
        }

        foreach ($columns as $index => $column) {
            $width = max($column);
            if (!is_null($this->style->getColumnMaxWidth())) {
                $width = min($width, $this->style->getColumnMaxWidth());
            }
            $this->columnsWidth[$index] = $width;
        }

    }*/
}
