<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\ConsoleRender;

$drawer = new ConsoleRender(11, 10);
$drawer->addFigure(new \ConsoleDraw\Figure\Geometry\Circle\Circle(5,5, 4, '*'));
echo $drawer->render();
