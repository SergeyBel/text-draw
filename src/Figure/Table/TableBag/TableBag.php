<?php

namespace TextDraw\Figure\Table\TableBag;

use TextDraw\Common\TextFrame;

class TableBag
{
    /**
     * @var array<<TableElement>
     */
    private array $table;


    public function addRow(array $row)
    {
        foreach ($row as $cell) {
            $this->table[] = new TableElement(
                new TextFrame(
                    $cell->getText(),
                )
            );
        }
    }

    /**
     * @var array<<TableElement>
     */
    public function getRows(): array
    {
        return $this->table;
    }

}