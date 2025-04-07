<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Table;

use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Turtle\Turtle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class Table extends FrameFigure
{
    /** @var array<string>  */
    private array $header = [];

    /** @var array<array<string>>  */
    private array $rows = [];

    public function __construct(
        Size $size,
        ?Point $leftUpperCorner = null
    ) {
        parent::__construct($size, $leftUpperCorner);
    }


    public function draw(): array
    {
        $cellWidth = $this->calculateCellWidth();
        $cellCount = count($this->header);
        $start = $this->getLeftUpperCorner();

        $start = $this->drawHeader($start, $cellCount, $cellWidth);
        $this->drawRows($start, $cellCount, $cellWidth);

        return parent::draw();
    }

    private function drawHeader(Point $start, int $cellCount, int $cellWidth): Point
    {
        $this->drawSeparator($start, $cellCount, $cellWidth);
        $start = $start->addY(1);
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
            ->paintRight('|');


        foreach ($row as $cell) {
            $text = str_pad($cell, $cellWidth, ' ');
            $turtle
                ->paintText($text)
                ->paintRight('|');
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
     * @param array<array<string>> $rows
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
            ->paintRight('+');

        for ($i = 0; $i < $cellCount; $i++) {
            $turtle
                ->paintRight('-', $cellWidth)
                ->paintRight('+');
        }

        $this->addFigure($turtle);
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


}
