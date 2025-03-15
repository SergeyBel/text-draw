<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Console;
use ConsoleDraw\Figure\Geometry\Triangle\Triangle;
use ConsoleDraw\Plane\Point;

$drawer = new Console(16, 16);
$drawer->addFigure(new Triangle(new Point(1, 1), new Point(12, 1), new Point(12, 15)));
echo $drawer->render();