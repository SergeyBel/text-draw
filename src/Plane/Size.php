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

    public function setWidth(int $width): Size
    {
        $this->width = $width;
        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): Size
    {
        $this->height = $height;
        return $this;
    }

    public function addWidth(int $value): self
    {
        $that = clone $this;
        $that->width += $value;
        return $that;
    }

    public function subWidth(int $value): self
    {
        $that = clone $this;
        $that->width -= $value;
        return $that;
    }

    public function addHeight(int $value): self
    {
        $that = clone $this;
        $that->height += $value;
        return $that;
    }

    public function subHeight(int $value): self
    {
        $that = clone $this;
        $that->height -= $value;
        return $that;
    }


}
