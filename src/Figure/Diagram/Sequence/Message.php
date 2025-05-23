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

    public function getTo(): ?string
    {
        return $this->to;
    }

    public function setTo(?string $to): void
    {
        $this->to = $to;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function setFrom(?string $from): void
    {
        $this->from = $from;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }


}
