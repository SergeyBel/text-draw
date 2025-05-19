<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

class Message
{
    public function __construct(
        private string $text,
        private ?string $from = null,
        private ?string $to = null,
    ) {
    }
}
