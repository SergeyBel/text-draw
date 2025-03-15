<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Console;
use ConsoleDraw\Figure\Geometry\Circle\Circle;
use ConsoleDraw\Plane\Point;

$drawer = new Console(10, 10);
$drawer->addFigure(new Circle(new Point(5,5), 4));
echo $drawer->render();
