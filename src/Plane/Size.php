<?php

declare(strict_types=1);

namespace ConsoleDraw\Plane;

class Size
{
    public function __construct(
        private int $width,
        private int $height,
    ) {
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): static
    {
        $this->width = $width;
        return $this;
    }


    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): static
    {
        $this->height = $height;
        return $this;
    }


    public function addWidth(int $value): static
    {
        $that = clone $this;
        $that->width += $value;
        return $that;
    }

    public function subWidth(int $value): static
    {
        $that = clone $this;
        $that->width -= $value;
        return $that;
    }

    public function addHeight(int $value): static
    {
        $that = clone $this;
        $that->height += $value;
        return $that;
    }

    public function subHeight(int $value): static
    {
        $that = clone $this;
        $that->height -= $value;
        return $that;
    }


}
