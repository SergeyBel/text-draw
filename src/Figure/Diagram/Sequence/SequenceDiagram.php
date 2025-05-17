<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Pixel\PixelMatrix;

class SequenceDiagram extends BaseFigure
{
    /**
     * @var array<Actor>
     */
    private array $actors = [];

    /**
     * @var array<Message>
     */
    private array $messages = [];

    /**
     * @var array<Action>
     */
    private array $actions = [];


    public function draw(): PixelMatrix
    {

        return parent::draw();
    }

}
