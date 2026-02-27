<?php

declare(strict_types=1);

namespace TextDraw\Render\ImageRender;

use TextDraw\Render\ImageRender\Color\RgbColor;

class ImageRenderStyle
{
    private int $fontSize = 16;
    private string $font = __DIR__ . '/font/UbuntuMono-Regular.ttf';
    private RgbColor $backgroundColor;
    private RgbColor $textColor;

    public function __construct()
    {
        $this->backgroundColor = new RgbColor(255, 255, 255);
        $this->textColor = new RgbColor(0, 0, 0);
    }


    public function getFontSize(): int
    {
        return $this->fontSize;
    }

    public function setFontSize(int $fontSize): static
    {
        $this->fontSize = $fontSize;
        return $this;
    }

    public function getFont(): string
    {
        return $this->font;
    }

    public function setFont(string $font): static
    {
        $this->font = $font;
        return $this;
    }

    public function getBackgroundColor(): RgbColor
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(RgbColor $backgroundColor): static
    {
        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    public function getTextColor(): RgbColor
    {
        return $this->textColor;
    }

    public function setTextColor(RgbColor $textColor): static
    {
        $this->textColor = $textColor;
        return $this;
    }





}
