<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, int $value) : void
 */
class IntegerCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(TypeCheckerFactory::integerChecker(), $items);
    }

    public function offsetGet($offset): ?int
    {
        return $this->items[$offset] ?? null;
    }
}
