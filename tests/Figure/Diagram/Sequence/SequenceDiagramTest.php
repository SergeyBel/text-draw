<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagram\Sequence;

use TextDraw\Figure\Diagram\Sequence\Actor;
use TextDraw\Figure\Diagram\Sequence\Message;
use TextDraw\Figure\Diagram\Sequence\SequenceDiagram;
use TextDraw\Tests\Figure\FigureTestCase;

class SequenceDiagramTest extends FigureTestCase
{
    public function testTwoActorsOneMessage(): void
    {
        $diagram = new SequenceDiagram(
        );

        $diagram->addActors(
            [
                new Actor('A', 'a'),
                new Actor('B', 'b'),
            ]
        )->addMessages([
            new Message('hello', 'a', 'b')
        ])
        ;


        $this->addFigure($diagram);


        $expected = <<<EOD
        +---+.....+---+
        |.A.|.....|.B.|
        +---+.....+---+
        ..|..hello..|..
        ..|-------->|..
        ..|.........|..
        EOD;

        $this->assertRender($expected);
    }

    public function testWithoutMessages(): void
    {
        $diagram = new SequenceDiagram(
        );

        $diagram->addActors(
            [
                new Actor('A', 'a'),
                new Actor('B', 'b'),
            ]
        )
        ;


        $this->addFigure($diagram);


        $expected = <<<EOD
        +---+...+---+
        |.A.|...|.B.|
        +---+...+---+
        ..|.......|..
        EOD;

        $this->assertRender($expected);
    }

    public function testSelfMessage(): void
    {
        $diagram = new SequenceDiagram(
        );

        $diagram->addActors(
            [
                new Actor('A', 'a'),
                new Actor('B', 'b'),
            ]
        )->addMessages([
            new Message('hi', 'a', 'a')
        ])
        ;


        $this->addFigure($diagram);


        $expected = <<<EOD
        +---+...+---+
        |.A.|...|.B.|
        +---+...+---+
        hi|.......|..
        ..|.......|..
        EOD;

        $this->assertRender($expected);
    }

}
