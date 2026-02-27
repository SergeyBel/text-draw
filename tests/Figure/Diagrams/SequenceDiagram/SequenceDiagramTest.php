<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagrams\SequenceDiagram;

use TextDraw\Figure\Diagrams\SequenceDiagram\Actor;
use TextDraw\Figure\Diagrams\SequenceDiagram\Message;
use TextDraw\Figure\Diagrams\SequenceDiagram\SequenceDiagram;
use TextDraw\Figure\Diagrams\SequenceDiagram\SequenceDiagramStyle;
use TextDraw\Tests\Figure\FigureTestCase;

class SequenceDiagramTest extends FigureTestCase
{
    public function testTwoActorsOneMessage(): void
    {
        $diagram = new SequenceDiagram()->setStyle($this->getStyle());

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
        +-+.....+-+
        |A|.....|B|
        +-+.....+-+
        .|.hello.|.
        .|------>|.
        .|.......|.
        EOD;

        $this->assertRender($expected);
    }

    public function testWithoutMessages(): void
    {
        $diagram = new SequenceDiagram()->setStyle($this->getStyle());

        $diagram->addActors(
            [
                new Actor('A', 'a'),
                new Actor('B', 'b'),
            ]
        )
        ;


        $this->addFigure($diagram);


        $expected = <<<EOD
        +-+...+-+
        |A|...|B|
        +-+...+-+
        .|.....|.
        EOD;

        $this->assertRender($expected);
    }

    public function testSelfMessage(): void
    {

        $diagram = new SequenceDiagram()->setStyle($this->getStyle());

        $diagram->addActors(
            [
                new Actor('A', 'a'),
                new Actor('B', 'b'),
            ]
        )->addMessages([
            new Message('hi', 'a')
        ])
        ;


        $this->addFigure($diagram);


        $expected = <<<EOD
        +-+...+-+
        |A|...|B|
        +-+...+-+
        .|hi...|.
        .|.....|.
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): SequenceDiagramStyle
    {
        return new SequenceDiagramStyle();
    }

}
