<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\Math\_2D;

class Point2D
{
    public function __construct(
        protected int $x,
        protected int $y
    ) {}

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getCoordinates(): string
    {
        return "$this->x,$this->y";
    }

    public function rotateOnAxis(string $axis, float $angle): self
    {
        $angleRad = deg2rad($angle);

        $x = $this->x;
        $y = $this->y;

        if ($axis === 'x') {
            $y = $this->y * round(cos($angleRad));
        } else {
            $x = $this->x * round(cos($angleRad));
        }

        return new self((int) $x, (int) $y);
    }

    public function translate(Vector2D $vector): self
    {
        return new self(
            $this->x + $vector->getX(),
            $this->y + $vector->gety()
        );
    }

    public function __toString(): string
    {
        return "($this->x,$this->y)";
    }
}
