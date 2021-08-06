<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use Oxidmod\TypedCollections\SimpleCollection\StringCollection;

class StringCollectionTest extends AbstractSimpleCollectionTest
{
    protected function createCollection(array $rawData): AbstractCollection
    {
        return new StringCollection($rawData);
    }

    protected function getCollectionName(): string
    {
        return StringCollection::class;
    }

    protected function generateValidItem()
    {
        return random_int(0, 1) ? '' : random_bytes(8);
    }

    protected function isValidItem($item): bool
    {
        return is_string($item);
    }
}
