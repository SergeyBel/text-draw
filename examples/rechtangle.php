<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\ConsoleRender;

$drawer = new ConsoleRender(17, 16);
$drawer->addFigure(new \ConsoleDraw\Figure\Geometry\Rechtangle\Rectangle(1,1,10,10,'*'));
echo $drawer->render();