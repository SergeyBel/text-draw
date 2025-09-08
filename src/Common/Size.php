<?php

declare(strict_types=1);

namespace TextDraw\Common;

class Size
{
    private PositiveInt $width;
    private PositiveInt $height;


    public function __construct(
        int $width,
        int $height,
    ) {
        $this->width = new PositiveInt($width);
        $this->height = new PositiveInt($height);
    }

    /**
     * @return int<1, max>
     */
    public function getWidth(): int
    {
        return $this->width->getValue();
    }

    /**
     * @return int<1, max>
     */
    public function getHeight(): int
    {
        return $this->height->getValue();
    }

    public function addWidth(int $value): static
    {
        $that = clone $this;
        $that->width = $that->width->add($value);
        return $that;
    }

    public function subWidth(int $value): static
    {
        $that = clone $this;
        $that->width = $that->width->sub($value);
        return $that;
    }

    public function addHeight(int $value): static
    {
        $that = clone $this;
        $that->height = $that->height->add($value);
        return $that;
    }

    public function subHeight(int $value): static
    {
        $that = clone $this;
        $that->height = $that->height->sub($value);
        return $that;
    }

}
