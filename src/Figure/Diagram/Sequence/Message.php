<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

class Message
{
    public function __construct(
        private string $from,
        private string $to,
        private string $text
    ) {
    }
}
