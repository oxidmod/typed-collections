<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, array $value) : void
 */
class ArrayCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(TypeCheckerFactory::arrayChecker(), $items);
    }

    public function offsetGet($offset): ?array
    {
        return $this->items[$offset] ?? null;
    }
}
