<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

use TextDraw\Common\TextAlign;

class TableCell
{
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
