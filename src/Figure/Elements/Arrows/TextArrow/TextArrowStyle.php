<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Arrows\TextArrow;

use TextDraw\Figure\Elements\Arrows\Arrow\ArrowStyle;

class TextArrowStyle
{
    private ArrowStyle $arrowStyle;

    public function __construct()
    {
        $this->arrowStyle = new ArrowStyle()->setChar(null);
    }

    public function getArrowStyle(): ArrowStyle
    {
        return $this->arrowStyle;
    }

    public function setArrowStyle(ArrowStyle $arrowStyle): self
    {
        $this->arrowStyle = $arrowStyle;
        return $this;
    }


}
