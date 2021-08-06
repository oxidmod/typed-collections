<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleCollection;

use Oxidmod\TypedCollections\SimpleCollection\AbstractCollection;
use PHPUnit\Framework\TestCase;

abstract class AbstractSimpleCollectionTest extends TestCase
{
    /**
     * @param array $rawData
     * @param iterable $expected
     *
     * @dataProvider getIteratorProvider
     */
    public function testGetIterator(array $rawData, iterable $expected): void
    {
        $collection = $this->createCollection($rawData);

        $this->assertEquals($expected, $collection->getIterator(), 'Iterators are not equals');
    }

    /**
     * @param array $rawData
     * @param $offset
     * @param bool $expected
     *
     * @dataProvider offsetExistsProvider
     */
    public function testOffsetExists(array $rawData, $offset, bool $expected): void
    {
        $collection = $this->createCollection($rawData);

        $this->assertSame($expected, $collection->offsetExists($offset), 'offsetExists fail');
        $this->assertSame($expected, isset($collection[$offset]), 'isset fail');
    }

    public function testOffsetSet(): void
    {
        $collection = $this->createCollection([]);

        $value = $this->generateValidItem();

        $collection[] = $value;
        $this->assertTrue($collection->offsetExists(0));
        $this->assertSame($value, $collection[0]);

        $collection['key'] = $value;
        $this->assertTrue($collection->offsetExists('key'));
        $this->assertSame($value, $collection['key']);

        $collection->offsetSet(1, $value);
        $this->assertTrue($collection->offsetExists(1));
        $this->assertSame($value, $collection[1]);

        $collection->offsetSet('another_key', $value);
        $this->assertTrue($collection->offsetExists('another_key'));
        $this->assertSame($value, $collection['another_key']);
    }

    /**
     * @param array $rawData
     * @param $offset
     *
     * @dataProvider offsetUnsetProvider
     */
    public function testOffsetUnset(array $rawData, $offset): void
    {
        $collection = $this->createCollection($rawData);

        $collection->offsetUnset($offset);
        $this->assertFalse($collection->offsetExists($offset));
    }

    /**
     * @param array $rawData
     * @param $offset
     *
     * @dataProvider offsetUnsetProvider
     */
    public function testUnset(array $rawData, $offset): void
    {
        $collection = $this->createCollection($rawData);

        unset($collection[$offset]);
        $this->assertFalse($collection->offsetExists($offset));
    }

    /**
     * @param array $rawData
     * @param int $expected
     *
     * @dataProvider countProvider
     */
    public function testCount(array $rawData, int $expected): void
    {
        $collection = $this->createCollection($rawData);

        $this->assertSame($expected, $collection->count());
        $this->assertCount($expected, $collection);
    }

    /**
     * @param array $rawData
     *
     * @dataProvider createProvider
     */
    public function testCreate(array $rawData): void
    {
        $collection = $this->createCollection($rawData);

        $this->assertSame($rawData, iterator_to_array($collection->getIterator()));
    }

    /**
     * @param mixed $value
     * @param string $expectedExceptionMessage
     * @param string $expectedExceptionClass
     *
     * @dataProvider errorValueProvider
     */
    public function testCreateError(
        $value,
        string $expectedExceptionMessage,
        string $expectedExceptionClass = \InvalidArgumentException::class
    ): void {
        $this->expectException($expectedExceptionClass);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $this->createCollection([$value]);
    }

    /**
     * @param mixed $value
     * @param string $expectedExceptionMessage
     * @param string $expectedExceptionClass
     *
     * @dataProvider errorValueProvider
     */
    public function testOffsetSetError(
        $value,
        string $expectedExceptionMessage,
        string $expectedExceptionClass = \InvalidArgumentException::class
    ) {
        $collection = $this->createCollection([]);

        $this->expectException($expectedExceptionClass);
        $this->expectExceptionMessage($expectedExceptionMessage);

        $collection[] = $value;
    }

    public function getIteratorProvider(): array
    {
        $emptyRawData = [];
        $rawDataWithNumericKeys = [
            $this->generateValidItem(),
            $this->generateValidItem(),
            $this->generateValidItem(),
        ];

        $rawDataWithStringKeys = [
            'key' => $this->generateValidItem(),
            'another' => $this->generateValidItem(),
        ];

        $rawDataWithMixedKeys = [
            $this->generateValidItem(),
            'key' => $this->generateValidItem(),
            $this->generateValidItem(),
        ];

        return [
            'empty collection' => [$emptyRawData, new \ArrayIterator($emptyRawData)],
            'with numeric keys' => [$rawDataWithNumericKeys, new \ArrayIterator($rawDataWithNumericKeys)],
            'with string keys' => [$rawDataWithStringKeys, new \ArrayIterator($rawDataWithStringKeys)],
            'with mixed keys' => [$rawDataWithMixedKeys, new \ArrayIterator($rawDataWithMixedKeys)],
        ];
    }

    public function offsetExistsProvider(): array
    {
        $rawData = [
            $this->generateValidItem(),
            'key' => $this->generateValidItem(),
        ];

        return [
            'empty collection, numeric offset' => [[], 42, false],
            'empty collection, string offset' => [[], 'key', false],
            'collection, numeric offset hit' => [$rawData, 0, true],
            'collection, numeric offset miss' => [$rawData, 1, false],
            'collection, string offset hit' => [$rawData, 'key', true],
            'collection, string offset miss' => [$rawData, 'another_key', false],
        ];
    }

    public function offsetUnsetProvider(): array
    {
        $rawData = [
            $this->generateValidItem(),
            'key' => $this->generateValidItem(),
        ];

        return [
            'existing numeric key' => [$rawData, 0],
            'not existing numeric key' => [$rawData, 100],
            'existing string key' => [$rawData, 'key'],
            'not existing string key' => [$rawData, 'another_key'],
        ];
    }

    public function countProvider(): array
    {
        $rawData = [
            $this->generateValidItem(),
            'key' => $this->generateValidItem(),
        ];

        return [
            'empty collection' => [[], 0],
            'not empty collection' => [$rawData, 2],
        ];
    }

    public function createProvider(): array
    {
        return $this->countProvider();
    }

    public function errorValueProvider(): array
    {
        $className = $this->getCollectionName();

        $cases = [
            'boolean' => [
                true,
                sprintf('Value of type "boolean" is not allowed for "%s"', $className),
            ],
            'null' => [
                null,
                sprintf('Value of type "NULL" is not allowed for "%s"', $className),
            ],
            'float' => [
                66.6,
                sprintf('Value of type "double" is not allowed for "%s"', $className),
            ],
            'integer' => [
                42,
                sprintf('Value of type "integer" is not allowed for "%s"', $className),
            ],
            'string' => [
                'str_value',
                sprintf('Value of type "string" is not allowed for "%s"', $className),
            ],
            'array' => [
                [1, 2, 3],
                sprintf('Value of type "array" is not allowed for "%s"', $className),
            ],
            'object' => [
                new \stdClass(),
                sprintf('Value of type "stdClass" is not allowed for "%s"', $className),
            ],
            'resource' => [
                fopen('php://memory', 'r'),
                sprintf('Value of type "resource" is not allowed for "%s"', $className),
            ],
        ];

        return array_filter($cases, fn(array $case) => !$this->isValidItem($case[0]));
    }

    abstract protected function createCollection(array $rawData): AbstractCollection;

    abstract protected function getCollectionName(): string;

    /**
     * @return mixed
     */
    abstract protected function generateValidItem();

    /**
     * @param mixed $item
     * @return bool
     */
    abstract protected function isValidItem($item): bool;
}
