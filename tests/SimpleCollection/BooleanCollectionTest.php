<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use Oxidmod\TypedCollections\SimpleCollection\BooleanCollection;

class BooleanCollectionTest extends AbstractSimpleCollectionTest
{
    protected function createCollection(array $rawData): AbstractCollection
    {
        return new BooleanCollection($rawData);
    }

    protected function getCollectionName(): string
    {
        return BooleanCollection::class;
    }

    protected function generateValidItem()
    {
        return (bool)random_int(0, 1);
    }

    protected function isValidItem($item): bool
    {
        return is_bool($item);
    }
}
