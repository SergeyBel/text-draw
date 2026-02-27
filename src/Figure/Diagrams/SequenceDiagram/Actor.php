<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\SequenceDiagram;

class Actor
{
    public function __construct(
        private string $text,
        private string $name
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
