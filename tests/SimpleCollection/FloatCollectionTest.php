<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use Oxidmod\TypedCollections\SimpleCollection\FloatCollection;

class FloatCollectionTest extends AbstractSimpleCollectionTest
{
    protected function createCollection(array $rawData): AbstractCollection
    {
        return new FloatCollection($rawData);
    }

    protected function getCollectionName(): string
    {
        return FloatCollection::class;
    }

    protected function generateValidItem()
    {
        return (float)random_int(PHP_INT_MIN, PHP_INT_MAX) / mt_getrandmax();
    }

    protected function isValidItem($item): bool
    {
        return is_float($item);
    }
}
