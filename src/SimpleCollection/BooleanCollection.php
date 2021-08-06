<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

/**
 * @method offsetSet($offset, bool $value) : void
 */
class BooleanCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(TypeCheckerFactory::booleanChecker(), $items);
    }

    public function offsetGet($offset): ?bool
    {
        return $this->items[$offset] ?? null;
    }
}
