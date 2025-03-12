<?php

require_once __DIR__ . '/../vendor/autoload.php';
use ConsoleDraw\ConsoleDrawer;
use ConsoleDraw\Pixel;

$drawer = new ConsoleDrawer(17, 16);
$drawer->addFigure(new \ConsoleDraw\Triangle(1, 1, 12, 1, 12, 15,'*'));
echo $drawer->draw();