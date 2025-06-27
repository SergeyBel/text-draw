<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

use TextDraw\Common\TextFrame;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Figure\Table\TableBag\TableBag;
use TextDraw\Figure\Text\Text;
use TextDraw\Figure\Turtle\Turtle;
use TextDraw\Plane\Point;

class Table extends BaseFigure
{
    private TableStyle $style;

    private TableBag $table;

    /**
     * @var array<string|TableCell>
     */
    private array $header = [];

    /**
     * @var array<array<string|TableCell>>
     */
    private array $rows = [];

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


    public function draw(): PixelMatrix
    {
        $this->prepareTable();
        $start = new Point(0, 0);
        $this->drawTable($start);

        return parent::draw();
    }

    private function drawTable(Point $start): void
    {
        foreach ($this->table->getTable() as $row) {
            $this->drawRow($start, $row);
            $start = $start->addY(2);
        }
    }

    /**
     * @param array<TextFrame> $row
     */
    private function drawRow(Point $start, array $row): void
    {
        foreach ($row as $element) {
            $this->drawElement($start, $element);
            $start = $start->addX($element->getWidth() + 1);
        }
    }

    private function drawElement(Point $start, TextFrame $element): void
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

    private function drawElementBorder(Turtle $turtle, TextFrame $element): Turtle
    {
        $turtle
            ->paintRight($this->style->getCrossingChar())
            ->paintRight($this->style->getHorizontalChar(), $element->getWidth())
            ->paint($this->style->getCrossingChar())
        ;

        return $turtle;
    }

    private function drawElementText(Turtle $turtle, TextFrame $element): Turtle
    {
        $turtle->paintRight($this->style->getVerticalChar());

        $text = Text::fromTextFrame($turtle->getPosition(), $element);
        $this->addFigure($text);

        $turtle
            ->moveRight($element->getWidth())
            ->paint($this->style->getVerticalChar());

        return $turtle;
    }

    private function prepareTable(): void
    {
        if (count($this->header) > 0) {
            $header = [];
            foreach ($this->header as $cell) {
                if (is_string($cell)) {
                    $header[] = new TableCell($cell, align: $this->style->getHeaderAlign());
                } else {
                    $header[] = $cell;
                }
            }
            $this->table->addRow($header);
        }


        foreach ($this->rows as $row) {
            $tableRow = [];
            foreach ($row as $cell) {
                if (is_string($cell)) {
                    $tableRow[] = new TableCell($cell, align: $this->style->getAlign());
                } else {
                    $tableRow[] = $cell;
                }
            }
            $this->table->addRow($tableRow);
        }

    }

}
