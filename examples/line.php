<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Drawer;
use \ConsoleDraw\Plane\Point;
use \ConsoleDraw\Figure\Geometry\Line\Line;

$drawer = new Drawer(10, 10);
$drawer->addFigure(new Line(new Point(0, 0), new Point(8, 8)));
echo $drawer->render();