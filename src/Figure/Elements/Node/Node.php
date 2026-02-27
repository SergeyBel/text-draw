<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Node;

class Node
{
    public function __construct(
        private readonly string $text,
        private readonly NodeShape $shape = NodeShape::RECTANGLE
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getShape(): NodeShape
    {
        return $this->shape;
    }


}
