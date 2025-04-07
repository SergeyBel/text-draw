<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ConsoleDraw\Render\ConsoleRender\ConsoleRender;
use ConsoleDraw\Render\TextRender\TextRender;
use ConsoleDraw\Figure\Table\Table;

$render = new ConsoleRender(80, 20);
$table = (new Table($render->getMatrixSize()))
    ->setHeader(['ISBN', 'Title', 'Author'])
    ->setRows([
        ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
        ['9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'],
        ['960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'],
        ['80-902734-1-6', 'And Then There Were None', 'Agatha Christie'],
    ]);
$render->addFigure($table);
$render->render();