<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\Arrow;

use TextDraw\Common\Char;

class ArrowStyle
{
    private ?Char $char = null;


    public function getChar(): ?string
    {

        return $this->char?->getChar();
    }

    public function setChar(?string $char): self
    {
        $this->char = !is_null($char) ? new Char($char) : $char;
        return $this;
    }


}
