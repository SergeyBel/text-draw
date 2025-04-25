<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ImageRender;

use ConsoleDraw\Common\Size;

class Image
{
    public function __construct(
        private string $path,
        private Size $size
    ) {
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function getPath(): string
    {
        return $this->path;
    }



}
