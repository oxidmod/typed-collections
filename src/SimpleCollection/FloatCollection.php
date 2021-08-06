<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, float $value) : void
 */
class FloatCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(TypeCheckerFactory::floatChecker(), $items);
    }

    public function offsetGet($offset): ?float
    {
        return $this->items[$offset] ?? null;
    }
}
