<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ConsoleRender;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\RenderInterface;
use ConsoleDraw\Render\TextRender\TextRender;
use Exception;

class ConsoleRender implements RenderInterface
{
    private TextRender $textRender;

    public function __construct(
        ?int $width = null,
        ?int $height = null,
    ) {
        if (is_null($width)) {
            $width = $this->detectWidth();
        }

        if (is_null($height)) {
            $height = $this->detectHeight();
        }

        $this->textRender = new TextRender($width - 1, $height);
    }

    public function render(): void
    {
        $text = $this->textRender->render();
        echo $text;

    }

    public function setPixel(Pixel $pixel): static
    {
        $this->textRender->setPixel($pixel);
        return $this;
    }

    public function setPixels(array $pixels): static
    {
        $this->textRender->setPixels($pixels);
        return $this;
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

    public function getSize(): Size
    {
        return $this->textRender->getSize();
    }

}
