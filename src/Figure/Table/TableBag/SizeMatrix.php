<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table\TableBag;

use TextDraw\Common\Exception\RenderException;

class SizeMatrix
{
    /**
     * @var array<array<int|null>>
     */
    private array $sizes;

    /**
     * @param array<array<int|null>>  $sizes
     */
    public function __construct(array $sizes = [])
    {
        $this->sizes = $sizes;
    }

    /**
     * @param array<int|null> $row
     * @return $this
     */
    public function addRow(array $row): static
    {
        $this->sizes[] = $row;
        return $this;
    }

    /**
     * @return array<array<int>>
     */
    public function calculate(): array
    {
        for ($j = 0; $j < $this->countColumns(); $j++) {
            $columnMax = $this->getColumnMax($j);
            $this->update($j, $columnMax);
        }


        /** @var int[][] $sizes */
        $sizes = $this->sizes;

        return $sizes;
    }


    private function getColumnMax(int $j): int
    {
        $column = [];
        for ($i = 0; $i < $this->countRows(); $i++) {
            if (!is_null($this->sizes[$i][$j])) {
                $column[] = $this->sizes[$i][$j];
            }
        }
        if (count($column) === 0) {
            throw new RenderException('Empty table size column');
        }

        return max($column);
    }

    private function update(int $j, int $value): void
    {
        for ($i = 0; $i < $this->countRows(); $i++) {
            if (is_null($this->sizes[$i][$j])) {
                $k = $j;
                while (is_null($this->sizes[$i][$k])) {
                    $k++;
                }
                $this->sizes[$i][$k] -= $value;
            }
            $this->sizes[$i][$j] = $value;
        }
    }

    private function countColumns(): int
    {
        return count($this->sizes[0]);

    }

    private function countRows(): int
    {
        return count($this->sizes);

    }

}
