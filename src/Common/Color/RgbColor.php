<?php

declare(strict_types=1);

namespace TextDraw\Common\Color;

class RgbColor
{
    private Channel $red;
    private Channel $green;
    private Channel $blue;


    public function __construct(int $red, int $green, int $blue)
    {
        $this->red = new Channel($red);
        $this->green = new Channel($green);
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
