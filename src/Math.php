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

class Math
{
    /**
     * Alias method for Math::greatCommonDivisor()
     *
     * @param list<int> $numbers
     */
    public static function gcd(array $numbers): int
    {
        return self::greatCommonDivisor($numbers);
    }

    /**
     * Alias method for Math::leastCommonMultiple()
     *
     * @param list<int> $numbers
     */
    public static function lcm(array $numbers): int
    {
        return self::leastCommonMultiple($numbers);
    }

    /**
     * @param list<int> $numbers
     */
    public static function greatCommonDivisor(array $numbers): int
    {
        $gcd = (int) array_shift($numbers);
        foreach ($numbers as $number) {
            $a = max($gcd, $number);
            $b = min($gcd, $number);
            $r = $a % $b;

            while ($r > 0) {
                $a = $b;
                $b = $r;
                $r = $a % $b;
            }

            $gcd = $b;
        }

        return $gcd;
    }

    /**
     * @param list<int> $numbers
     */
    private static function leastCommonMultiple(array $numbers): int
    {
        $gcd = self::greatCommonDivisor($numbers);
        $lcm = (int) array_shift($numbers);
        foreach ($numbers as $number) {
            $lcm = ($lcm * $number) / $gcd;
        }

        return (int) $lcm;
    }
}
