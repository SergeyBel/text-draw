<?php

namespace TextDraw\Figure\Graph;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Screen\Screen;

class Graph extends BaseFigure
{
    public function getScreen(): Screen
    {
        $this->makeAsyclic();
        $this->calculateLayers();
        $this->addPseudonNodes();
        $this->draw();
        return parent::getScreen();
    }


}