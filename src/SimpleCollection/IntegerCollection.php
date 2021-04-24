<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, int $value) : void
 */
class IntegerCollection extends AbstractCollection
{
    protected static function createTypeChecker(): \Closure
    {
        return TypeCheckerFactory::integerChecker();
    }

    public function offsetGet($offset): ?int
    {
        return $this->items[$offset] ?? null;
    }
}
