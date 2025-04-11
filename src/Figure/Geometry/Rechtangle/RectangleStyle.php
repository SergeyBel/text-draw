<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Rechtangle;

use ConsoleDraw\Figure\Geometry\Line\LineStyle;

class RectangleStyle
{
    private string $symbol = '*';

    /**
     * @var array<string, LineStyle>
     */
    private array $styleOrder = [];

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }

    /**
     * @return array<string, LineStyle>
     */
    public function getSideStyles(): array
    {
        return $this->styleOrder;
    }

    public function setSideStyle(RectangleSide $side, LineStyle $sideStyle): self
    {
        $this->styleOrder[$side->value] = $sideStyle;
        return $this;
    }

}
