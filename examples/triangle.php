<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Drawer;
use ConsoleDraw\Figure\Geometry\Triangle\Triangle;
use ConsoleDraw\Plane\Point;

$drawer = new Drawer(16, 16);
$drawer->addFigure(new Triangle(new Point(1, 1), new Point(12, 1), new Point(12, 15)));
echo $drawer->render();