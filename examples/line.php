<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\ConsoleRender;

$drawer = new ConsoleRender(10, 10);
$drawer->addFigure(new \ConsoleDraw\Figure\Geometry\Line\Line(0, 0, 8, 8));
echo $drawer->render();