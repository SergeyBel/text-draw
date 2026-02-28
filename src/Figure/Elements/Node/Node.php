<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Node;

use TextDraw\Plane\Point;

class Node
{
    public function __construct(
        private readonly Point $corner,
        private readonly string $text,
        private readonly NodeShape $shape = NodeShape::RECTANGLE
    ) {
    }

    public function getCorner(): Point
    {
        return $this->corner;
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
