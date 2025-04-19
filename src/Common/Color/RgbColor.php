<?php

declare(strict_types=1);

namespace ConsoleDraw\Common\Color;

class RgbColor
{
    private Channel $red;
    private Channel $green;
    private Channel $blue;


    public function __construct(int $red, int $green, int $blue)
    {
        $this->setRed($red);
        $this->setGreen($green);
        $this->setBlue($blue);
    }


    public function setRed(int $red): void
    {
        $this->red = new Channel($red);
    }


    public function setGreen(int $green): void
    {
        $this->green = new Channel($green);
    }

    public function setBlue(int $blue): void
    {
        $this->blue = new Channel($blue);
    }

    /**
     * @return int<0, 255>
     */
    public function getRed(): int
    {
        return $this->red->getValue();
    }

    /**
     * @return int<0, 255>
     */
    public function getGreen(): int
    {
        return $this->green->getValue();
    }

    /**
     * @return int<0, 255>
     */
    public function getBlue(): int
    {
        return $this->blue->getValue();
    }
}
