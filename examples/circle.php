<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Figure\Geometry\Circle\Circle;
use ConsoleDraw\Plane\Point;

$render = new ConsoleDraw\Render\ConsoleRender\ConsoleRender();
$render->addFigure(new Circle(new Point(5, 5), 4));
$render->render();
