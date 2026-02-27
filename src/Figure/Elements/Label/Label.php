<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Label;

use TextDraw\Plane\Point;

class Label
{
    /**
     * @var array<string>
     */
    private array $lines;

    public function __construct(
        private readonly Point $start,
        private string $text
    ) {
        $this->lines = explode("\n", $this->text);
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getStart(): Point
    {
        return $this->start;
    }


    /**
     * @return array<string>
     */
    public function getLines(): array
    {
        return $this->lines;
    }


}
