<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\LineChart;

use TextDraw\Common\Char;

class DatasetStyle
{
    private Char $lineChar;
    private ?Char $pointChar = null;

    public function __construct()
    {
        $this->lineChar = new Char('*');
    }

    public function getLineChar(): string
    {
        return $this->lineChar->getChar();
    }

    public function setLineChar(string $lineChar): self
    {
        $this->lineChar = new Char($lineChar);
        return $this;
    }

    public function getPointChar(): ?string
    {
        return $this->pointChar?->getChar();
    }

    public function setPointChar(string $pointChar): self
    {
        $this->pointChar = new Char($pointChar);
        return $this;
    }
}
