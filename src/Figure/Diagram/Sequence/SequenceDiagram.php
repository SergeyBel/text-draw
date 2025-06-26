<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Diagram\Elements\TextArrow\TextArrow;
use TextDraw\Figure\Diagram\Elements\TextBox\TextBox;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;

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

    /** @var array<string, TextBox> */
    private array $actorsBoxes = [];

    private SequenceDiagramStyle $style;

    public function __construct()
    {
        $this->style = new SequenceDiagramStyle();
        parent::__construct();
    }

    public function getStyle(): SequenceDiagramStyle
    {
        return $this->style;
    }

    public function setStyle(SequenceDiagramStyle $style): void
    {
        $this->style = $style;
    }

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
        $firstBox = $this->actorsBoxes[array_key_first($this->actorsBoxes)];
        $height = $this->drawMessages(
            $firstBox->getSize()->getHeight()
        );
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
        $textBox = new TextBox(
            $actor->getText(),
            $leftCorner,
        )->setStyle(
            $this->style->getActorStyle()
        );

        $this->addFigure($textBox);


        if (!is_null($actor->getName())) {
            $this->actorsBoxes[$actor->getName()] = $textBox;
        }

        return $leftCorner
            ->addX($textBox->getSize()->getWidth())
            ->addX($gap);
    }

    private function drawMessages(int $startY): int
    {
        $currentY = $startY;

        foreach ($this->messages as $message) {
            if ($message->isSelfMessage()) {
                $currentY = $this->drawSelfMessage($message, $currentY);
            } else {
                $currentY = $this->drawMessage($message, $currentY);
                ;
            }

        }

        return $currentY;
    }

    private function drawSelfMessage(Message $message, int $y): int
    {
        $box = $this->actorsBoxes[$message->getFrom()];
        $start = new Point($box->getLeftUpperCorner()->getX(), $y);
        $this->addFigure(new Text($start, $message->getText()));
        return $y + 1;

    }

    private function drawMessage(Message $message, int $y): int
    {
        $boxFrom = $this->actorsBoxes[$message->getFrom()];
        $boxTo = $this->actorsBoxes[$message->getTo()];

        $start = new Point($this->getBoxBottomCenter($boxFrom)->addX(1)->getX(), $y + 1);
        $end = new Point($this->getBoxBottomCenter($boxTo)->subX(1)->getX(), $y + 1);

        $this->addFigure(
            new TextArrow(
                $message->getText(),
                $start,
                $end
            )
        );
        return $y + 2;

    }

    private function drawLifeLines(int $height): void
    {
        foreach ($this->actorsBoxes as $box) {
            $start = $this->getBoxBottomCenter($box)->addY(1);
            $end = $start->addY($height)->subY($box->getSize()->getHeight());
            $this->addFigure(
                new Line(
                    $start,
                    $end
                )->setStyle(
                    new LineStyle()->setSymbol('|')
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
        $lengths = [];
        foreach ($this->messages as $message) {
            if (!$message->isSelfMessage()) {
                $lengths[] = mb_strlen($message->getText());
            }
        }

        if (count($lengths) === 0) {
            return $this->style->getDefaultGap();
        }

        return max($lengths);
    }
}
