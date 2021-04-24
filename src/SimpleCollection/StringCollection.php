<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, string $value) : void
 */
class StringCollection extends AbstractCollection
{
    protected static function createTypeChecker(): \Closure
    {
        return TypeCheckerFactory::stringChecker();
    }

    public function offsetGet($offset): ?string
    {
        return $this->items[$offset] ?? null;
    }
}
