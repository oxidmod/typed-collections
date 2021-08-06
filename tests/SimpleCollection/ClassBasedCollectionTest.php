<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use Oxidmod\TypedCollections\Tests\SimpleTestCollection\ClassBasedCollectionCustom;
use Oxidmod\TypedCollections\Tests\SimpleTestCollection\TestItem;
use Oxidmod\TypedCollections\Tests\SimpleTestCollection\TestItemChild;

class ClassBasedCollectionTest extends AbstractSimpleCollectionTest
{
    protected function createCollection(array $rawData): AbstractCollection
    {
        return new ClassBasedCollectionCustom($rawData);
    }

    protected function getCollectionName(): string
    {
        return ClassBasedCollectionCustom::class;
    }

    protected function generateValidItem()
    {
        return random_int(0, 1) ? new TestItem() : new TestItemChild();
    }

    protected function isValidItem($item): bool
    {
        return $item instanceof TestItem;
    }
}
