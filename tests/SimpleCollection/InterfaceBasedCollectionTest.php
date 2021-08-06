<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use Oxidmod\TypedCollections\Tests\SimpleTestCollection\InterfaceBasedCollectionCustom;
use Oxidmod\TypedCollections\Tests\SimpleTestCollection\TestInterfaceImpl;
use Oxidmod\TypedCollections\Tests\SimpleTestCollection\TestItemChild;
use Oxidmod\TypedCollections\Tests\SimpleTestCollection\TestItemInterface;

class InterfaceBasedCollectionTest extends AbstractSimpleCollectionTest
{
    protected function createCollection(array $rawData): AbstractCollection
    {
        return new InterfaceBasedCollectionCustom($rawData);
    }

    protected function getCollectionName(): string
    {
        return InterfaceBasedCollectionCustom::class;
    }

    protected function generateValidItem()
    {
        return random_int(0, 1) ? new TestItemChild() : new TestInterfaceImpl();
    }

    protected function isValidItem($item): bool
    {
        return $item instanceof TestItemInterface;
    }
}
