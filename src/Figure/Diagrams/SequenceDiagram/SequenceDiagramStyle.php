<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\SequenceDiagram;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Figure\Elements\TextBox\TextBoxStyle;
use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;

class SequenceDiagramStyle
{
    private TextBoxStyle $actorStyle;

    private int $defaultGap = 3;

    public function __construct(
    ) {
        $this->actorStyle = new TextBoxStyle()
                ->setTextHorizontalAlign(HorizontalAlign::Center)
                ->setTextVerticalAlign(\TextDraw\Common\VerticalAlign::Center)
                ->setRectangleStyle(
                    new RectangleStyle()
                        ->setHorizontalChar('-')
                        ->setVerticalChar('|')
                        ->setCrossingChar('+')
                )
        ;
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
