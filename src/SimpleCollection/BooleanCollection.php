<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, bool $value) : void
 */
class BooleanCollection extends AbstractCollection
{
    protected static function createTypeChecker(): \Closure
    {
        return TypeCheckerFactory::booleanChecker();
    }

    public function offsetGet($offset): ?bool
    {
        return $this->items[$offset] ?? null;
    }
}
