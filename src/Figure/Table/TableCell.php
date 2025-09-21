<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

class TableCell
{
    private TableCellStyle $style;

    public function __construct(
        private string $text,
        private int $colspan = 1,
    ) {
        $this->style = new TableCellStyle();
    }


    public function getText(): string
    {
        return $this->text;
    }

    public function getColspan(): int
    {
        return $this->colspan;
    }

    public function setText(string $text): static
    {
        $this->text = $text;
        return $this;
    }

    public function setColspan(int $colspan): static
    {
        $this->colspan = $colspan;
        return $this;
    }

    public function setStyle(TableCellStyle $style): self
    {
        $this->style = $style;
        return $this;
    }

    public function getStyle(): TableCellStyle
    {
        return $this->style;
    }


}
