<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

class Actor
{
    public function __construct(
        private string $text,
        private string $name
    ) {
    }
}
