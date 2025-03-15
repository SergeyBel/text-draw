<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Console;
use ConsoleDraw\Figure\FunctionGraph\FunctionGraph;

$drawer = new Console(60, 20);
$function = new FunctionGraph(60, 20);

$values = [];
for ($y = 1; $y <= 50; $y++) {
    $values[] = new \ConsoleDraw\Figure\FunctionGraph\FunctionValue($y, - abs($y - 30) + 15);
}
$function->setValues($values);
$drawer->addFigure($function);

echo $drawer->render();
