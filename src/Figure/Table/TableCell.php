<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Table;

class TableCell
{
    private ?string $leftChar = null;
    public function __construct(
        private string $text,
        private int $colspan = 1,
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getColspan(): int
    {
        return $this->colspan;
    }

    public function setText(string $text): TableCell
    {
        $this->text = $text;
        return $this;
    }

    public function setColspan(int $colspan): TableCell
    {
        $this->colspan = $colspan;
        return $this;
    }

    public function getLeftChar(): ?string
    {
        return $this->leftChar;
    }

    public function setLeftChar(?string $leftChar): TableCell
    {
        $this->leftChar = $leftChar;
        return $this;
    }




}
