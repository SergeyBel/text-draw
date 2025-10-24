<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table\TableBag;

use TextDraw\Common\HorizontalAlign;

class TextCell
{
    public function __construct(
        public string $text,
        public int $width,
        public HorizontalAlign $align
    ) {
    }

}
