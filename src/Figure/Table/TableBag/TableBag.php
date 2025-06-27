<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table\TableBag;

use TextDraw\Common\TextFrame;
use TextDraw\Figure\Table\TableCell;

class TableBag
{
    /**
     * @var TableCell[][]
     */
    private array $cells;

    /**
     * @param array<TableCell> $row
     */
    public function addRow(array $row): static
    {
        $this->cells[] = $row;
        return $this;
    }

    /**
     * @return array<array<TextFrame>>
     */
    public function getTable(): array
    {
        $sizes = $this->prepare();

        $table = [];
        $calculatedSizes = $sizes->calculate();
        for ($i = 0; $i < count($this->cells); $i++) {
            $row = [];
            for ($j = 0; $j < count($this->cells[$i]); $j++) {
                $cell = $this->cells[$i][$j];
                $width = 0;
                for ($c = 0; $c < $cell->getColspan(); $c++) {
                    $width += $calculatedSizes[$i][$j];
                }
                $row[] = new TextFrame($cell->getText(), $width, $cell->getAlign());
            }
            $table[] = $row;
        }

        return $table;
    }

    private function prepare(): SizeMatrix
    {
        $sizes = new SizeMatrix();
        foreach ($this->cells as $row) {
            $rowSizes = [];
            foreach ($row as $cell) {
                $rowSizes = array_merge($rowSizes, array_fill(0, $cell->getColspan() - 1, null), [mb_strlen($cell->getText())]);

            }
            $sizes->addRow($rowSizes);
        }
        return $sizes;
    }




}
