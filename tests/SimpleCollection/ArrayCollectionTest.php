<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use Oxidmod\TypedCollections\SimpleCollection\ArrayCollection;

class ArrayCollectionTest extends AbstractSimpleCollectionTest
{
    private const RAW_DATA_MIXED = [
        [42],
        'key' => ['value'],
    ];

    protected function createCollection(array $rawData): AbstractCollection
    {
        return new ArrayCollection($rawData);
    }

    protected function getCollectionName(): string
    {
        return ArrayCollection::class;
    }

    protected function generateValidItem()
    {
        $result = [];
        $length = random_int(1, 3);
        for ($i = 0; $i <= $length; $i++) {
            $key = random_int(0, 1) ? $i : sprintf('key_%d', $i);
            $result[$key] = random_int(0, 1) ? random_int(PHP_INT_MIN, PHP_INT_MAX) : random_bytes(8);
        }

        return $result;
    }

    protected function isValidItem($item): bool
    {
        return is_array($item);
    }
}
