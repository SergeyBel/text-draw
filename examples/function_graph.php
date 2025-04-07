<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\ConsoleRender\ConsoleRender;
use ConsoleDraw\Render\TextRender\TextRender;
use ConsoleDraw\Figure\FunctionGraph\FunctionGraph;
use ConsoleDraw\Figure\FunctionGraph\FunctionValue;

$render = new ConsoleRender(61, 20);
$function = new FunctionGraph($render->getMatrixSize());

$values = [];
for ($x = 0; $x <= 60; $x++) {
    $values[] = new FunctionValue($x, abs($x - 10));
}
$function->setValues($values);
$render->addFigure($function);

$render->render();
