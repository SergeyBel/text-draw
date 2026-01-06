<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Line;

use TextDraw\Common\Char;

class LineStyle
{
    private Char $char;
    private ?Char $startChar = null;
    private ?Char $endChar = null;

    public function __construct()
    {
        $this->char = new Char('*');
    }

    public function getChar(): string
    {
        return $this->char->getChar();
    }

    public function setChar(string $char): self
    {
        $this->char = new Char($char);
        return $this;
    }

    public function getStartChar(): ?string
    {
        return $this->startChar?->getChar();
    }

    public function setStartChar(?string $startChar): LineStyle
    {
        $this->startChar = !is_null($startChar) ? new Char($startChar) : null;
        return $this;
    }

    public function getEndChar(): ?string
    {
        return $this->endChar?->getChar();
    }

    public function setEndChar(?string $endChar): LineStyle
    {
        $this->endChar = !is_null($endChar) ? new Char($endChar) : null;
        return $this;
    }
}
