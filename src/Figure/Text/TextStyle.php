<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Text;

class TextStyle
{
    private ?int $width = null;
    private string $paddingChar = ' ';

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): TextStyle
    {
        $this->width = $width;
        return $this;
    }

    public function getPaddingChar(): string
    {
        return $this->paddingChar;
    }

    public function setPaddingChar(string $paddingChar): TextStyle
    {
        $this->paddingChar = $paddingChar;
        return $this;
    }





}
