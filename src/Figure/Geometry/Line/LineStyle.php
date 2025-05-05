<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Line;

class LineStyle
{
    private string $symbol = '*';
    private ?string $startChar = null;
    private ?string $finishChar = null;

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    public function getStartChar(): ?string
    {
        return $this->startChar;
    }

    public function setStartChar(?string $startChar): LineStyle
    {
        $this->startChar = $startChar;
        return $this;
    }

    public function getFinishChar(): ?string
    {
        return $this->finishChar;
    }

    public function setFinishChar(?string $finishChar): LineStyle
    {
        $this->finishChar = $finishChar;
        return $this;
    }

}
