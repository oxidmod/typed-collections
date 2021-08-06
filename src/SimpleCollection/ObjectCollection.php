<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, object $value) : void
 */
class ObjectCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(TypeCheckerFactory::objectChecker(), $items);
    }

    public function offsetGet($offset): ?object
    {
        return $this->items[$offset] ?? null;
    }
}
