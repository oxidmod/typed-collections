<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections;

class TypeCheckerFactory
{
    private static array $checkers = [];

    public static function arrayChecker(): \Closure
    {
        return self::$checkers['array'] = self::$checkers['array'] ?? \Closure::fromCallable(
            fn($value) => is_array($value)
        );
    }

    public static function booleanChecker(): \Closure
    {
        return self::$checkers['boolean'] = self::$checkers['boolean'] ?? \Closure::fromCallable(
            fn($value) => is_bool($value)
        );
    }

    public static function floatChecker(): \Closure
    {
        return self::$checkers['float'] = self::$checkers['float'] ?? \Closure::fromCallable(
            fn($value) => is_float($value)
        );
    }

    public static function integerChecker(): \Closure
    {
        return self::$checkers['integer'] = self::$checkers['integer'] ?? \Closure::fromCallable(
            fn($value) => is_int($value)
        );
    }

    public static function objectChecker(): \Closure
    {
        return self::$checkers['object'] = self::$checkers['object'] ?? \Closure::fromCallable(
            fn($value) => is_object($value)
        );
    }

    public static function stringChecker(): \Closure
    {
        return self::$checkers['string'] = self::$checkers['string'] ?? \Closure::fromCallable(
            fn($value) => is_string($value)
        );
    }

    public static function customTypeChecker(string $type): \Closure
    {
        return self::$checkers[$type] = self::$checkers[$type] ?? \Closure::fromCallable(
            fn($value) => $value instanceof $type
        );
    }
}
