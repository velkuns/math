<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\Math\_2D;

class Vector2D
{
    protected Point2D $origin;
    protected Point2D $destination;
    protected int $x;
    protected int $y;

    public static function dir(int $x, int $y): self
    {
        return new self(new Point2D(0, 0), new Point2D($x, $y), false);
    }

    public function __construct(Point2D $p1, Point2D $p2, bool $sort = true)
    {
        if ($sort) {
            [$this->origin, $this->destination] = $this->sort($p1, $p2);
        } else {
            $this->origin      = $p1;
            $this->destination = $p2;
        }

        $this->x = $this->destination->getX() - $this->origin->getX();
        $this->y = $this->destination->getY() - $this->origin->getY();
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function isSameAs(Vector2D $vector): bool
    {
        return $this->getX() === $vector->getX() && $this->getY() === $vector->getY();
    }

    public function origin(): Point2D
    {
        return $this->origin;
    }

    public function destination(): Point2D
    {
        return $this->destination;
    }

    public function add(Vector2D $v): self
    {
        $p1 = $this->origin();
        $p2 = $this->destination()->translate($v);

        return new self($p1, $p2, false);
    }

    public function rotateOnAxis(string $axis, float $angle): Vector2D
    {
        $p1 = $this->origin->rotateOnAxis($axis, $angle);
        $p2 = $this->destination->rotateOnAxis($axis, $angle);

        return new self($p1, $p2);
    }

    public function squareSize(): int
    {
        return ($this->x * $this->x) + ($this->y * $this->y);
    }

    public function size(): float
    {
        return sqrt($this->squareSize());
    }

    public function manhattanDistance(): int
    {
        return abs($this->x) + abs($this->y);
    }

    public function __toString(): string
    {
        return $this->origin . ' -> ' . $this->destination .
            " : ($this->x,$this->y) [" . $this->manhattanDistance() . "]"
        ;
    }

    /**
     * @param Point2D $p1
     * @param Point2D $p2
     * @return array{0: Point2D, 1: Point2D}
     */
    protected function sort(Point2D $p1, Point2D $p2): array
    {
        if (
            $p1->getX() < $p2->getX() ||
            ($p1->getX() === $p2->getX() && $p1->getY() < $p2->getY())
        ) {
            $origin      = $p1;
            $destination = $p2;
        } else {
            $origin      = $p2;
            $destination = $p1;
        }

        return [$origin, $destination];
    }
}
