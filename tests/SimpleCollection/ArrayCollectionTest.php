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

    public function getIteratorProvider(): array
    {
        $emptyRawData = [];
        $rawDataWithNumericKeys = [
            [],
            ['value'],
            [42],
        ];
        $rawDataWithStringKeys = [
            'key' => ['value'],
            'another' => ['key', 'value'],
        ];


        return [
            'empty collection' => [$emptyRawData, new \ArrayIterator($emptyRawData)],
            'with numeric keys' => [$rawDataWithNumericKeys, new \ArrayIterator($rawDataWithNumericKeys)],
            'with string keys' => [$rawDataWithStringKeys, new \ArrayIterator($rawDataWithStringKeys)],
            'with mixed keys' => [self::RAW_DATA_MIXED, new \ArrayIterator(self::RAW_DATA_MIXED),
            ]
        ];
    }

    public function offsetExistsProvider(): array
    {
        return [
            'empty collection, numeric offset' => [[], 42, false],
            'empty collection, string offset' => [[], 'key', false],
            'collection, numeric offset hit' => [self::RAW_DATA_MIXED, 0, true],
            'collection, numeric offset miss' => [self::RAW_DATA_MIXED, 1, false],
            'collection, string offset hit' => [self::RAW_DATA_MIXED, 'key', true],
            'collection, string offset miss' => [self::RAW_DATA_MIXED, 'another_key', false],
        ];
    }

    public function offsetSetProvider(): array
    {
        return [
            'just an array' => [[]],
        ];
    }

    public function offsetUnsetProvider(): array
    {
        return [
            'existing numeric key' => [self::RAW_DATA_MIXED, 0],
            'not existing numeric key' => [self::RAW_DATA_MIXED, 100],
            'existing string key' => [self::RAW_DATA_MIXED, 'key'],
            'not existing string key' => [self::RAW_DATA_MIXED, 'another_key'],
        ];
    }

    public function countProvider(): array
    {
        return [
            'empty collection' => [[], 0],
            'not empty collection' => [self::RAW_DATA_MIXED, 2],
        ];
    }

    public function createProvider(): array
    {
        return $this->countProvider();
    }

    public function errorValueProvider(): array
    {
        $objectError = <<<OBJ_ERROR
Value "(object) array(
)" is not allowed for "Oxidmod\TypedCollections\SimpleCollection\ArrayCollection"
OBJ_ERROR;

        return [
            'boolean' => [
                true,
                'Value "true" is not allowed for "Oxidmod\TypedCollections\SimpleCollection\ArrayCollection"',
            ],
            'null' => [
                null,
                'Value "NULL" is not allowed for "Oxidmod\TypedCollections\SimpleCollection\ArrayCollection"',
            ],
            'float' => [
                66.6,
                'Value "66.6" is not allowed for "Oxidmod\TypedCollections\SimpleCollection\ArrayCollection"',
            ],
            'integer' => [
                42,
                'Value "42" is not allowed for "Oxidmod\TypedCollections\SimpleCollection\ArrayCollection"',
            ],
            'string' => [
                'str_value',
                'Value "\'str_value\'" is not allowed for "Oxidmod\TypedCollections\SimpleCollection\ArrayCollection"',
            ],
            'object' => [
                new \stdClass(),
                $objectError
            ],
//            var_export is not working properly for resources
//            todo: add error formatter
//            'resource' => [
//                fopen('php://memory', 'r'),
//                'TBD',
//            ],
        ];
    }

    protected function createCollection(array $rawData): AbstractCollection
    {
        return new ArrayCollection($rawData);
    }
}
