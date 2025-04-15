<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Table;

use ConsoleDraw\Figure\Text\TextAlign;

class TableCell
{
    private ?string $leftChar = null;

    public function __construct(
        private string $text,
        private int $colspan = 1,
        private TextAlign $align = TextAlign::Left,
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

    public function getLeftChar(): ?string
    {
        return $this->leftChar;
    }

    public function setLeftChar(?string $leftChar): static
    {
        $this->leftChar = $leftChar;
        return $this;
    }

    public function getAlign(): TextAlign
    {
        return $this->align;
    }

    public function setAlign(TextAlign $align): static
    {
        $this->align = $align;
        return $this;
    }






}
