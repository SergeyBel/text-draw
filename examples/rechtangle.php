<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Drawer;
use ConsoleDraw\Figure\Geometry\Rechtangle\Rectangle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

$drawer = new Drawer(16, 16);
$drawer->addFigure(new Rectangle(new Point(0, 0), new Size(10, 10)));
echo $drawer->render();