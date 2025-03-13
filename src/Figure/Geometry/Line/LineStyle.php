<?php

namespace ConsoleDraw\Figure\Geometry\Line;

class LineStyle
{
    private string $symbol = '*';
    private bool $excludeStart = false;
    private bool $excludeFinish = false;

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    public function isExcludeStart(): bool
    {
        return $this->excludeStart;
    }

    public function excludeStart(): LineStyle
    {
        $this->excludeStart = true;
        return $this;
    }

    public function isExcludeFinish(): bool
    {
        return $this->excludeFinish;
    }

    public function excludeFinish(): LineStyle
    {
        $this->excludeFinish = true;
        return $this;
    }




}
