<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, float $value) : void
 */
class FloatCollection extends AbstractCollection
{
    protected static function createTypeChecker(): \Closure
    {
        return TypeCheckerFactory::floatChecker();
    }

    public function offsetGet($offset): ?float
    {
        return $this->items[$offset] ?? null;
    }
}
