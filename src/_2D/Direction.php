<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\Math\_2D;

enum Direction: string
{
    case Up = '^';
    case Down = 'v';

    case Right = '>';

    case Left = '<';

    public static function fromVector(Vector2DDir $vector): Direction
    {
        return match (true) {
            $vector->onUp()    => Direction::Up,
            $vector->onDown()  => Direction::Down,
            $vector->onLeft()  => Direction::Left,
            $vector->onRight() => Direction::Right,
            true               => throw new \InvalidArgumentException('VectorDir must have direction!'),
        };
    }
}
