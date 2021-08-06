<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleTestCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCustomTypeCollection;

/**
 * @method offsetSet($offset, TestItem $value) : void
 */
class ClassBasedCollectionCustom extends AbstractCustomTypeCollection
{
    protected static function getType(): string
    {
        return TestItem::class;
    }

    public function offsetGet($offset): ?TestItem
    {
        return $this->items[$offset] ?? null;
    }
}
