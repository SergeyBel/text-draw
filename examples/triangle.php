<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\ConsoleRender;

$drawer = new ConsoleRender(17, 16);
$drawer->addFigure(new \ConsoleDraw\Figure\Geometry\Triangle\Triangle(1, 1, 12, 1, 12, 15,'*'));
echo $drawer->render();