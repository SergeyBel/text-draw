<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Sequence;

use TextDraw\Common\Size;
use TextDraw\Figure\Base\BaseFigureDrawer;
use TextDraw\Figure\Diagram\Elements\Arrow\Arrow;
use TextDraw\Figure\Diagram\Elements\Arrow\ArrowDirection;
use TextDraw\Figure\Diagram\Elements\TextBox\TextBox;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Figure\Text\Text;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class SequenceDiagram extends BaseFigureDrawer
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

    public function setStyle(SequenceDiagramStyle $style): self
    {
        $this->style = $style;
        return $this;
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



    public function draw(): Screen
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
        $textBoxSize = new Size(mb_strlen($actor->getText()) + 2, 3);
        $textBox = new TextBox(
            $actor->getText(),
            $leftCorner,
            $textBoxSize
        )->setStyle(
            $this->style->getActorStyle()
        );

        $this->addFigure($textBox);

        $this->actorsBoxes[$actor->getName()] = $textBox;


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
            }

        }

        return $currentY;
    }

    private function drawSelfMessage(Message $message, int $y): int
    {
        $box = $this->actorsBoxes[$message->getFrom()];
        $start = $box->getBottomCenter()->addX(1)->addY(1);
        $this->addFigure(new Text($start, $message->getText()));
        return $y + 1;

    }

    private function drawMessage(Message $message, int $y): int
    {
        $boxFrom = $this->actorsBoxes[$message->getFrom()];
        $boxTo = $this->actorsBoxes[$message->getTo()];

        $start = new Point($boxFrom->getBottomCenter()->addX(1)->getX(), $y + 1);
        $end = new Point($boxTo->getBottomCenter()->subX(1)->getX(), $y + 1);

        $this->addFigure(
            new Arrow($start, $end, ArrowDirection::SIDE, $message->getText())
        );
        return $y + 2;

    }

    private function drawLifeLines(int $height): void
    {
        foreach ($this->actorsBoxes as $box) {
            $start = $box->getBottomCenter()->addY(1);
            $end = $start->addY($height)->subY($box->getSize()->getHeight());
            $this->addFigure(
                new Line(
                    $start,
                    $end
                )->setStyle(
                    new LineStyle()->setChar('|')
                )
            );
        }
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
