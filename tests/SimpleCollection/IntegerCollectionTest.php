<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use Oxidmod\TypedCollections\SimpleCollection\IntegerCollection;

class IntegerCollectionTest extends AbstractSimpleCollectionTest
{
    protected function createCollection(array $rawData): AbstractCollection
    {
        return new IntegerCollection($rawData);
    }

    protected function getCollectionName(): string
    {
        return IntegerCollection::class;
    }

    protected function generateValidItem()
    {
        return random_int(PHP_INT_MIN, PHP_INT_MAX);
    }

    protected function isValidItem($item): bool
    {
        return is_integer($item);
    }
}
