<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\Math;

use Velkuns\Math\_2D\Point2D;

class Matrix
{
    /** @var array<int, array<int, mixed>> $matrix */
    private array $matrix;

    private int $minX;
    private int $maxX;
    private int $minY;
    private int $maxY;

    public static function fromCoordinates(Point2D $p1, Point2D $p2, mixed $default): self
    {
        return new self(
            array_fill(
                $p1->getX(),
                ($p2->getX() - $p1->getX() + 1),
                array_fill($p1->getY(), ($p2->getY() - $p1->getY() + 1), $default)
            )
        );
    }

    /**
     * @param array<int, array<int, mixed>> $matrix
     */
    public function __construct(array $matrix = [0 => []])
    {
        $this->matrix = $matrix;

        $keys = array_keys($this->matrix);
        $this->minX = min($keys);
        $this->maxX = max($keys);

        $this->minY = (int) min(array_map(fn($line) => empty($line) ? 0 : min(array_keys($line)), $this->matrix));
        $this->maxY = (int) max(array_map(fn($line) => empty($line) ? 0 : max(array_keys($line)), $this->matrix));
    }

    public function transpose(): self
    {
        $array = [];
        foreach ($this->matrix as $x => $column) {
            foreach ($column as $y => $value) {
                $array[$y][$x] = $value;
            }
        }

        return new self($array);
    }

    public function invert(): self
    {
        $matrix = $this->matrix;
        krsort($matrix);

        return new self($matrix);
    }

    public function height(): int
    {
        return count($this->matrix);
    }

    public function getMinX(): int
    {
        return $this->minX;
    }

    public function getMaxX(): int
    {
        return $this->maxX;
    }

    public function getMinY(): int
    {
        return $this->minY;
    }

    public function getMaxY(): int
    {
        return $this->maxY;
    }

    public function width(): int
    {
        return count($this->matrix[0] ?? []);
    }

    public function get(Point2D $point, mixed $default = null): mixed
    {
        return $this->matrix[$point->getX()][$point->getY()] ?? $default;
    }

    public function set(Point2D $point, mixed $value): static
    {
        $this->matrix[$point->getX()][$point->getY()] = $value;

        return $this;
    }

    public function locate(mixed $search): Point2D
    {
        $points = $this->locateAll($search);

        if (empty($points)) {
            throw new \UnexpectedValueException('Value not found!');
        }

        return reset($points);
    }

    /**
     * @param mixed $search
     * @return Point2D[]
     */
    public function locateAll(mixed $search): array
    {
        $lines = array_filter($this->matrix, fn($line) => in_array($search, $line));

        $points = [];
        foreach ($lines as $x => $line) {
            $column = array_filter($line, fn($char) => $char === $search);
            foreach (array_keys($column) as $y) {
                $points[] = new Point2D($x, $y);
            }
        }

        return $points;
    }

    public function sliceOnY(int $offset, ?int $length = null): self
    {
        $matrix = array_map(fn($line) => array_slice($line, $offset, $length, true), $this->matrix);

        return new self($matrix);
    }
}
