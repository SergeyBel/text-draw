<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Rechtangle;

class RectangleStyle
{
    private string $symbol = '*';

    private ?string $cornerSymbol = null;

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    public function getCornerSymbol(): ?string
    {
        return $this->cornerSymbol;
    }

    public function setCornerSymbol(?string $cornerSymbol): RectangleStyle
    {
        $this->cornerSymbol = $cornerSymbol;
        return $this;
    }
}
