<?php

namespace ConsoleDraw\Figure\Table;

use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Turtle\Turtle;

class Table extends FrameFigure
{
    /** @var array<string>  */
    private array $header = [];

    /** @var array<array<string>>  */
    private array $rows = [];


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
     * @param array<array<string>> $rows
     * @return $this
     */
    public function setRows(array $rows): Table
    {
        $this->rows = $rows;
        return $this;
    }

    public function draw(): array
    {
        $cellWidth = $this->calculateCellWidth();

        foreach ($this->rows as $row) {
            $this->drawRow(0, $row, $cellWidth);
        }
        return parent::draw();
    }

    private function calculateCellWidth(): int
    {
        $max = 0;
        foreach ($this->rows as $row) {
            foreach ($row as $cell) {
                $length = mb_strlen($cell);
                if ($length > $max) {
                    $max = $length;
                }
            }
        }

        return $max;
    }

    /**
     * @param array<string> $row
     */
    private function drawRow(int $y, array $row, int $cellWidth): void
    {
        $turtle = (new Turtle())
            ->moveTo(0, $y)
            ->setSymbol('|');


        foreach ($row as $cell) {
            $text = str_pad($cell, $cellWidth, ' ');
            $turtle
                ->setText($text)
                ->setSymbol('|');
        }

        $this->addFigure($turtle);
    }


}
