<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

use TextDraw\Common\HorizontalAlign;

class TableCellStyle
{
    private HorizontalAlign $align = HorizontalAlign::Left;

    public function setAlign(HorizontalAlign $align): self
    {
        $this->align = $align;
        return $this;
    }

    public function getAlign(): HorizontalAlign
    {
        return $this->align;
    }
}
