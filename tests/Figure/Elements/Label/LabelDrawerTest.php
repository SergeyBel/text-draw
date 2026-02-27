<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Elements\Label;

use TextDraw\Figure\Elements\Label\Label;
use TextDraw\Figure\Elements\Label\LabelDrawer;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class LabelDrawerTest extends FigureTestCase
{
    private LabelDrawer $drawer;
    public function setUp(): void
    {
        $this->drawer = new LabelDrawer();
    }

    public function testSimpleText(): void
    {
        $label = new Label(new Point(1, 0), 'Hello');

        $expected = <<<EOD
        .Hello
        EOD;

        $this->assertRender($expected, $this->drawer->draw($label));
    }

    public function testTextWithLineBreak(): void
    {
        $label = new Label(new Point(0, 0), "One\nTwo");

        $expected = <<<EOD
        One
        Two
        EOD;

        $this->assertRender($expected, $this->drawer->draw($label));
    }


}
