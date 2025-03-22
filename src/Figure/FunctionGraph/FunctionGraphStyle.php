<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\FunctionGraph;

class FunctionGraphStyle
{
    private string $xAxeSymbol = '|';
    private string $yAxeSymbol = '-';
    private string $pointSymbol = '*';
    private string $zeroSymbol = '0';
    private string $xLabel = 'X';
    private string $yLabel = 'Y';

    public function getXAxeSymbol(): string
    {
        return $this->xAxeSymbol;
    }

    public function setXAxeSymbol(string $xAxeSymbol): FunctionGraphStyle
    {
        $this->xAxeSymbol = $xAxeSymbol;
        return $this;
    }

    public function getYAxeSymbol(): string
    {
        return $this->yAxeSymbol;
    }

    public function setYAxeSymbol(string $yAxeSymbol): FunctionGraphStyle
    {
        $this->yAxeSymbol = $yAxeSymbol;
        return $this;
    }

    public function getPointSymbol(): string
    {
        return $this->pointSymbol;
    }

    public function setPointSymbol(string $pointSymbol): FunctionGraphStyle
    {
        $this->pointSymbol = $pointSymbol;
        return $this;
    }

    public function getZeroSymbol(): string
    {
        return $this->zeroSymbol;
    }

    public function setZeroSymbol(string $zeroSymbol): FunctionGraphStyle
    {
        $this->zeroSymbol = $zeroSymbol;
        return $this;
    }

    public function getXLabel(): string
    {
        return $this->xLabel;
    }

    public function setXLabel(string $xLabel): FunctionGraphStyle
    {
        $this->xLabel = $xLabel;
        return $this;
    }

    public function getYLabel(): string
    {
        return $this->yLabel;
    }

    public function setYLabel(string $yLabel): FunctionGraphStyle
    {
        $this->yLabel = $yLabel;
        return $this;
    }








}
