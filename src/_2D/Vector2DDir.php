<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\Math\_2D;

class Vector2DDir extends Vector2D
{
    public static function fromDirection(Direction $direction, int $norm = 1): self
    {
        return match ($direction) {
            Direction::Right => self::right($norm),
            Direction::Left  => self::left($norm),
            Direction::Down  => self::down($norm),
            Direction::Up    => self::up($norm),
        };
    }

    public static function left(int $norm = 1, bool $invert = false): self
    {
        return new self(new Point2D(0, 0), new Point2D($invert ? 1 : -1, 0), $norm);
    }

    public static function right(int $norm = 1, bool $invert = false): self
    {
        return new self(new Point2D(0, 0), new Point2D($invert ? -1 : 1, 0), $norm);
    }

    public static function down(int $norm = 1, bool $invert = false): self
    {
        return new self(new Point2D(0, 0), new Point2D(0, $invert ? 1 : -1), $norm);
    }

    public static function up(int $norm = 1, bool $invert = false): self
    {
        return new self(new Point2D(0, 0), new Point2D(0, $invert ? -1 : 1), $norm);
    }

    public function __construct(Point2D $p1, Point2D $p2, int $norm = 1)
    {
        $x = $p2->getX() - $p1->getX();
        $y = $p2->getY() - $p1->getY();

        $origin = new Point2D(0, 0);
        $destination = new Point2D(
            $x !== 0 ? $norm * ((int) ($x / abs($x))) : 0,
            $y !== 0 ? $norm * ((int) ($y / abs($y))) : 0,
        );

        parent::__construct($origin, $destination, false);
    }

    public function onUp(): bool
    {
        return $this->getY() === 1;
    }

    public function onDown(): bool
    {
        return $this->getY() === -1;
    }

    public function onLeft(): bool
    {
        return $this->getX() === -1;
    }

    public function onRight(): bool
    {
        return $this->getX() === 1;
    }
}
