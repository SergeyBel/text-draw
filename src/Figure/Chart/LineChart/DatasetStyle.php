<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\LineChart;

use TextDraw\Common\Char;

class DatasetStyle
{
    private Char $lineChar;

    public function __construct()
    {
        $this->lineChar = new Char('*');
    }

    public function getLineChar(): string
    {
        return $this->lineChar->getChar();
    }

    public function setLineChar(string $lineChar): self
    {
        $this->lineChar = new Char($lineChar);
        return $this;
    }
}
