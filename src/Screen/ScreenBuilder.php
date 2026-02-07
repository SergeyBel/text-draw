<?php

declare(strict_types=1);

namespace TextDraw\Screen;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineDrawer;

class ScreenBuilder
{
    private array $drawers = [];

    public function __construct()
    {
        $this->setDrawer(Line::class, new LineDrawer());
    }

    /**
     * @param array<FigureInterface> $figures
     * @throws RenderException
     */
    public function build(array $figures): Screen
    {
        $screen = new Screen();
        foreach ($figures as $figure) {
            $drawer = $this->getDrawer($figure);
            $screen->merge($drawer->draw($figure));
        }
        return $screen;
    }


    public function setDrawer(string $figureClass, object $drawer): self
    {
        $this->drawers[$figureClass] = $drawer;
        return $this;
    }

    private function getDrawer(object $figure): object
    {
        return $this->drawers[get_class($figure)] ?? throw new RenderException('Drawer not found');
    }

}
