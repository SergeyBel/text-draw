<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ConsoleRender;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Base\FigureInterface;
use ConsoleDraw\Render\RenderInterface;
use ConsoleDraw\Render\TextRender\TextRender;
use Exception;

class ConsoleRender implements RenderInterface
{
    private TextRender $textRender;

    public function __construct(
        ?Size $size = null,
    ) {

        if (is_null($size)) {
            $size = new Size($this->detectWidth(), $this->detectHeight());
        }

        $this->textRender = new TextRender($size->subWidth(1));
    }

    public function render(): void
    {
        $text = $this->textRender->render();
        echo $text;

    }

    public function addFigure(FigureInterface $figure): static
    {
        $this->textRender->addFigure($figure);
        return $this;
    }


    private function detectWidth(): int
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $commandResult = shell_exec('mode con');
            if (!is_string($commandResult)) {
                throw new Exception('mode con command error');
            }
            $consoleInfo = explode("\n", $commandResult);
            return (int)trim(explode(':', $consoleInfo[4])[1]);
        } else {
            return (int)shell_exec('tput cols');
        }

    }

    private function detectHeight(): int
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $commandResult = shell_exec('mode con');
            if (!is_string($commandResult)) {
                throw new Exception('mode con command error');
            }
            $consoleInfo = explode("\n", $commandResult);
            return (int)trim(explode(':', $consoleInfo[3])[1]);
        } else {
            return (int)exec('tput rows');
        }
    }


}
