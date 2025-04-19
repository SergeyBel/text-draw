<?php

declare(strict_types=1);

namespace ConsoleDraw\Common;

class Size
{
    private PositiveInt $width;
    private PositiveInt $height;


    public function __construct(
        int $width,
        int $height,
    ) {
        $this->setWidth($width);
        $this->setHeight($height);
    }

    /**
     * @return int<1, max>
     */
    public function getWidth(): int
    {
        return $this->width->getValue();
    }


    public function setWidth(int $width): static
    {
        $this->width = new PositiveInt($width);
        return $this;
    }

    /**
     * @return int<1, max>
     */
    public function getHeight(): int
    {
        return $this->height->getValue();
    }

    public function setHeight(int $height): static
    {
        $this->height = new PositiveInt($height);
        return $this;
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
