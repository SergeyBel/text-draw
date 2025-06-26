<?php

namespace TextDraw\Figure\Table\TableBag;

use TextDraw\Common\TextFrame;

class TableElement
{
    public function __construct(
        private TextFrame $textFrame,
    )
    {
    }

    public function getWidth(): int
    {
        return $this->textFrame->getWidth();
    }

    public function getTextFrame(): TextFrame
    {
        return $this->textFrame;
    }


}