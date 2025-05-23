<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Diagram\Elements\TextArrow\TextArrow;
use TextDraw\Figure\Diagram\Elements\TextBox\TextBox;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
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

    /** @var array <string, TextBox> */
    private array $actorsBoxes = [];


    /**
     * @param array<Actor> $actors
     */
    public function addActors(array $actors): static
    {
        $this->actors = array_merge($this->actors, $actors);
        return $this;
    }

    /**
     * @param array<Message> $messages
     */
    public function addMessages(array $messages): static
    {
        $this->messages = array_merge($this->messages, $messages);
        return $this;
    }


    public function draw(): PixelMatrix
    {
        $this->drawActors();
        $height = $this->drawMessages();
        $this->drawLifeLines($height);

        return parent::draw();
    }

    private function drawActors(): void
    {
        $gap = $this->calculateBoxGap();
        $boxLeftCorner = new Point(0, 0);
        foreach ($this->actors as $actor) {
            $boxLeftCorner = $this->drawActor($boxLeftCorner, $actor, $gap);
        }
    }

    private function drawActor(Point $leftCorner, Actor $actor, int $gap): Point
    {
        $rectangleStyle = (new RectangleStyle())
            ->setHorizontalChar('-')
            ->setVerticalChar('|')
            ->setCrossingChar('+');

        $textBox = (new TextBox(
            $actor->getText(),
            $leftCorner,
        ))->setStyle(
            (new TextBoxStyle())->setRectangleStyle(
                $rectangleStyle
            )
        );

        $this->addFigure($textBox);


        if (!is_null($actor->getName())) {
            $this->actorsBoxes[$actor->getName()] = $textBox;
        }

        return $leftCorner
            ->addX($textBox->getSize()->getWidth())
            ->addX($gap);
    }

    private function drawMessages(): int
    {
        $height = 1;

        foreach ($this->messages as $message) {
            $height++;
            $boxFrom = $this->actorsBoxes[$message->getFrom()];
            $boxTo = $this->actorsBoxes[$message->getTo()];

            $start = $this->getBoxBottomCenter($boxFrom)->addY($height)->addX(1);
            $end = $this->getBoxBottomCenter($boxTo)->addY($height)->subX(1);
            $this->addFigure(
                new TextArrow(
                    $message->getText(),
                    $start,
                    $end
                )
            );


        }

        return $height;
    }

    private function drawLifeLines(int $height): void
    {
        foreach ($this->actorsBoxes as $box) {
            $start = $this->getBoxBottomCenter($box)->addY(1);
            $end = $start->addY($height);
            $this->addFigure(
                (new Line(
                    $start,
                    $end
                ))->setStyle(
                    (new LineStyle())->setSymbol('|')
                )
            );
        }
    }



    private function getBoxBottomCenter(TextBox $box): Point
    {
        return $box->getLeftUpperCorner()
            ->addX(intdiv($box->getSize()->getWidth(), 2))
            ->addY($box->getSize()->getHeight() - 1);
    }

    private function calculateBoxGap(): int
    {
        if (count($this->messages) === 0) {
            return 3;
        }
        return max(array_map(fn (Message $message) => mb_strlen($message->getText()), $this->messages));
    }
}
