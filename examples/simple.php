<?php

require_once __DIR__ . '/../vendor/autoload.php';
use ConsoleDraw\ConsoleDrawer;
use ConsoleDraw\Point;

$drawer = new ConsoleDrawer(10, 10);
$drawer->addFigure(new \ConsoleDraw\Line(0, 0, 8, 8));
echo $drawer->draw();