<?php

require_once __DIR__ . '/../vendor/autoload.php';
use ConsoleDraw\ConsoleDrawer;
use ConsoleDraw\Point;

$drawer = new ConsoleDrawer(51, 50);
$drawer->addFigure(new \ConsoleDraw\Rectangle(1,1,20,20,'*'));
echo $drawer->draw();