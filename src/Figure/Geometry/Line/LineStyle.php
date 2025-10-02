<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Line;

use TextDraw\Common\Char;

class LineStyle
{
    private Char $char;
    private ?Char $startChar = null;
    private ?Char $finishChar = null;

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

    public function getFinishChar(): ?string
    {
        return $this->finishChar?->getChar();
    }

    public function setFinishChar(?string $finishChar): LineStyle
    {
        $this->finishChar = !is_null($finishChar) ? new Char($finishChar) : null;
        return $this;
    }
}
