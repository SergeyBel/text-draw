<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Render\ImageRender;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Table\Table;
use ConsoleDraw\Render\ImageRender\ImageRender;

class ImageRenderTest extends \PHPUnit\Framework\TestCase
{
    public function testTable()
    {
        $render = new ImageRender(16, 7);

        $table = (new Table(new Size(16, 7)))
            ->setHeader(['City', 'Value'])
            ->addRows([
                ['London', '12000'],
                ['New York', '540'],
            ]);
        $render->addFigure($table);

        $filePath = __DIR__.'/table.png';
        $expectedFilePath = __DIR__.'/expected/table.png';

        $render->render($filePath);

        $this->assertEquals(file_get_contents($filePath), file_get_contents($expectedFilePath));
        unlink($filePath);
    }

}
