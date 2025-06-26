<?php

namespace TextDraw\Figure\Table\TableBag;

use TextDraw\Common\TextFrame;
use TextDraw\Figure\Table\TableCell;

class TableBag
{
    /**
     * @var array<<TableElement>
     */
    private array $table;


    /**
     * @param array<TableCell> $row
     */
    public function addRow(array $row): static
    {
        $elementsRow = [];
        foreach ($row as $cell) {
            $elementsRow[] = new TableElement(
                new TextFrame(
                    $cell->getText(),
                    align: $cell->getAlign()
                )
            );
        }

        $this->table[] = $elementsRow;
        return $this;
    }

    /**
     * @var array<<TableElement>>
     */
    public function getRows(): array
    {
        $this->round();
        return $this->table;
    }

    private function round(): void
    {
        $columns = [];
        foreach ($this->table as $row) {
            foreach ($row as $index => $element) {
                $columns[$index][] = $element->getLength();
            }
        }
    }

}