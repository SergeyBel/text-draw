<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Diagram\Elements\TextBox\TextBox;
use TextDraw\Figure\Geometry\Rechtangle\RectangleStyle;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\Diagram\Elements\TextBox\TextBoxStyle;

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

    private array $actorsPositions = [];



    public function draw(): PixelMatrix
    {
        $this->drawActors();
        //$this->drawMessages();
        //$this->drawLifeLines();

        return parent::draw();
    }

    public function addActors(array $actors): static
    {
        $this->actors = array_merge($this->actors, $actors);
        return $this;
    }

    public function addMessages(array $messages): static
    {
        $this->messages = array_merge($this->messages, $messages);
        return $this;
    }

    private function drawActors(): void
    {
        $start = new Point(0, 0);
        foreach ($this->actors as $actor) {
            $start = $this->drawActor($start, $actor);

        }
    }

    private function drawActor(Point $start, Actor $actor): Point
    {
        $rectangleStyle = (new RectangleStyle())
            ->setHorizontalChar('-')
            ->setVerticalChar('|')
            ->setCrossingChar('+');

        $textBox = (new TextBox(
            $actor->getText(),
            $start,
        ))->setStyle(
            (new TextBoxStyle())->setRectangleStyle(
                $rectangleStyle
            )
        );

        $this->addFigure($textBox);


        if (!is_null($actor->getName())) {
            $this->actorsPositions[$actor->getName()] =
                $start
                    ->addX(intdiv($textBox->getSize()->getWidth(), 2))
                    ->addY($textBox->getSize()->getHeight());
        }

        return $start
            ->addX($textBox->getSize()->getWidth())
            ->addX(5);
    }
}
