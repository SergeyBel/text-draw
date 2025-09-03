<?php

declare(strict_types=1);

namespace TextDraw\Figure\Base;

use TextDraw\Screen\Screen;

interface FigureInterface
{
    public function draw(): Screen;


}
