<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleTestCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCustomTypeCollection;

/**
 * @method offsetSet($offset, TestItemInterface $value) : void
 */
class InterfaceBasedCollectionCustom extends AbstractCustomTypeCollection
{
    protected static function getType(): string
    {
        return TestItemInterface::class;
    }

    public function offsetGet($offset): ?TestItemInterface
    {
        return $this->items[$offset] ?? null;
    }
}
