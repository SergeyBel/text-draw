<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

use TextDraw\Common\TextAlign;

class TableCellStyle
{
    private TextAlign $align = TextAlign::Left;

    public function setAlign(TextAlign $align): self
    {
        $this->align = $align;
        return $this;
    }

    public function getAlign(): TextAlign
    {
        return $this->align;
    }
}
