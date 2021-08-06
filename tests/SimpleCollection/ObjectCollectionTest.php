<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use Oxidmod\TypedCollections\SimpleCollection\ObjectCollection;

class ObjectCollectionTest extends AbstractSimpleCollectionTest
{
    protected function createCollection(array $rawData): AbstractCollection
    {
        return new ObjectCollection($rawData);
    }

    protected function getCollectionName(): string
    {
        return ObjectCollection::class;
    }

    protected function generateValidItem()
    {
        return random_int(0, 1) ? new \stdClass() : new \DateTime();
    }

    protected function isValidItem($item): bool
    {
        return is_object($item);
    }
}
