<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Line;

class LineStyle
{
    private string $symbol = '*';
    private ?string $startSymbol = null;
    private ?string $finishSymbol = null;

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    public function getStartSymbol(): ?string
    {
        return $this->startSymbol;
    }

    public function setStartSymbol(?string $startSymbol): LineStyle
    {
        $this->startSymbol = $startSymbol;
        return $this;
    }

    public function getFinishSymbol(): ?string
    {
        return $this->finishSymbol;
    }

    public function setFinishSymbol(?string $finishSymbol): LineStyle
    {
        $this->finishSymbol = $finishSymbol;
        return $this;
    }

}
