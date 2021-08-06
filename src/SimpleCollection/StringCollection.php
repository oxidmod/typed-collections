<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, string $value) : void
 */
class StringCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(TypeCheckerFactory::stringChecker(), $items);
    }

    public function offsetGet($offset): ?string
    {
        return $this->items[$offset] ?? null;
    }
}
