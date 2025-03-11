<?php

require_once __DIR__ . '/../vendor/autoload.php';
use ConsoleDraw\ConsoleDrawer;
use ConsoleDraw\Point;

$drawer = new ConsoleDrawer(11, 10);
$drawer->addFigure(new \ConsoleDraw\Circle(5,5, 4, '*'));
echo $drawer->draw();
