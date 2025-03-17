<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Console;
use ConsoleDraw\Figure\Table\Table;
use \ConsoleDraw\Plane\Point;
use \ConsoleDraw\Figure\Geometry\Line\Line;

$drawer = new Console(30, 10);
$table = (new Table())->setRows(
    [
        ['first', 'second', 'third']
    ]
);
$drawer->addFigure($table);
echo $drawer->render();