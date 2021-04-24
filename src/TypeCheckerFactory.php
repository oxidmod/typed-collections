<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections;

class TypeCheckerFactory
{
    public static function arrayChecker(): \Closure
    {
        return \Closure::fromCallable(fn($value) => is_array($value));
    }

    public static function booleanChecker(): \Closure
    {
        return \Closure::fromCallable(fn($value) => is_bool($value));
    }

    public static function floatChecker(): \Closure
    {
        return \Closure::fromCallable(fn($value) => is_float($value));
    }

    public static function integerChecker(): \Closure
    {
        return \Closure::fromCallable(fn($value) => is_int($value));
    }

    public static function objectChecker(): \Closure
    {
        return \Closure::fromCallable(fn($value) => is_object($value));
    }

    public static function stringChecker(): \Closure
    {
        return \Closure::fromCallable(fn($value) => is_string($value));
    }

    public static function typeChecker(string $type): \Closure
    {
        return \Closure::fromCallable(fn($value) => $value instanceof $type);
    }
}
