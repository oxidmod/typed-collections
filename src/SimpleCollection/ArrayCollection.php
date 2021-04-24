<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, array $value) : void
 */
class ArrayCollection extends AbstractCollection
{
    protected static function createTypeChecker(): \Closure
    {
        return TypeCheckerFactory::arrayChecker();
    }

    public function offsetGet($offset): ?array
    {
        return $this->items[$offset] ?? null;
    }
}
