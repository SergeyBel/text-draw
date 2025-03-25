<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Drawer;
use ConsoleDraw\Figure\FunctionGraph\FunctionGraph;
use ConsoleDraw\Figure\FunctionGraph\FunctionValue;

$drawer = new Drawer(60, 20);
$function = new FunctionGraph();

$values = [];
for ($x = 0; $x <= 60; $x++) {
    $values[] = new FunctionValue($x, abs($x - 10));
}
$function->setValues($values);
$drawer->addFigure($function);

echo $drawer->render();
