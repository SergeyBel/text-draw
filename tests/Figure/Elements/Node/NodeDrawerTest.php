<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Elements\Node;

use TextDraw\Figure\Elements\Node\Node;
use TextDraw\Figure\Elements\Node\NodeDrawer;
use TextDraw\Figure\Elements\Node\NodeShape;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class NodeDrawerTest extends FigureTestCase
{
    private NodeDrawer $drawer;
    public function setUp(): void
    {
        $this->drawer = new NodeDrawer();
    }

    public function testRectangleNode(): void
    {
        $node = new Node(
            new Point(0, 0),
            'test',
            NodeShape::class::RECTANGLE
        );

        $expected = <<<EOD
        +------+
        |......|
        |.test.|
        |......|
        +------+
        EOD;

        $this->assertRender($expected, $this->drawer->draw($node));
    }

}
