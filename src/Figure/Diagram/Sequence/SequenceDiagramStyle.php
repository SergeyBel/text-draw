<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

use TextDraw\Figure\Geometry\Rechtangle\RectangleStyle;
use TextDraw\Tests\Figure\Diagram\Elements\TextBox\TextBoxStyle;

class SequenceDiagramStyle
{
    private TextBoxStyle $actorStyle;

    private int $defaultGap = 3;

    public function __construct(
    ) {
        $this->actorStyle = new TextBoxStyle()->setRectangleStyle(
            new RectangleStyle()
                ->setHorizontalChar('-')
                ->setVerticalChar('|')
                ->setCrossingChar('+')
        );
    }

    public function getActorStyle(): TextBoxStyle
    {
        return $this->actorStyle;
    }

    public function setActorStyle(TextBoxStyle $actorStyle): self
    {
        $this->actorStyle = $actorStyle;
        return $this;
    }

    public function getDefaultGap(): int
    {
        return $this->defaultGap;
    }

    public function setDefaultGap(int $defaultGap): self
    {
        $this->defaultGap = $defaultGap;
        return $this;
    }






}
