<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, object $value) : void
 */
class ObjectCollection extends AbstractCollection
{
    protected static function createTypeChecker(): \Closure
    {
        return TypeCheckerFactory::objectChecker();
    }

    public function offsetGet($offset): ?object
    {
        return $this->items[$offset] ?? null;
    }
}
