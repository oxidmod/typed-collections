<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

abstract class AbstractTypeCollection extends AbstractCollection
{
    abstract protected static function getType(): string;

    protected static function createTypeChecker(): \Closure
    {
        return TypeCheckerFactory::typeChecker(static::getType());
    }
}
