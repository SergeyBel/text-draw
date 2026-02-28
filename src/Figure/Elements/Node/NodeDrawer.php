<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Node;

use TextDraw\Figure\Elements\Geometry\Rectangle\Rectangle;
use TextDraw\Figure\Elements\Geometry\Rectangle\RectangleDrawer;
use TextDraw\Figure\Elements\Label\Label;
use TextDraw\Figure\Elements\Label\LabelDrawer;
use TextDraw\Screen\Screen;

class NodeDrawer
{
    public const GAP = 1;

    public function draw(Node $node): Screen
    {
        return match($node->getShape()) {
            NodeShape::RECTANGLE => $this->drawRectangle($node)
        };
    }

    private function drawRectangle(Node $node): Screen
    {
        $screen = new Screen();

        $rectangleDrawer = new RectangleDrawer();
        $labelDrawer = new LabelDrawer();

        $label = new Label(
            $node->getCorner()->addX(1)->addY(1),
            $node->getText()
        );

        $screen = $screen->merge($labelDrawer->draw($label));
        $screen = $screen->merge(
            $rectangleDrawer->draw(
                new Rectangle(
                    $node->getCorner(),
                    $label->getSize()
                    ->addHeight((self::GAP + 1) * 2)
                    ->addWidth((self::GAP + 1) * 2)
                )
            )
        );


        return $screen;
    }

}
