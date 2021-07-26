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

        $this->assertEquals($expected, $collection->getIterator());
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

        $this->assertSame($expected, $collection->offsetExists($offset));
        $this->assertSame($expected, isset($collection[$offset]));
        $this->assertSame(!$expected, empty($collection[$offset]));
    }

    /**
     * @param $value
     *
     * @dataProvider offsetSetProvider
     */
    public function testOffsetSet($value): void
    {
        $collection = $this->createCollection([]);

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

    abstract public function getIteratorProvider(): array;

    abstract public function offsetExistsProvider(): array;

    abstract public function offsetSetProvider(): array;

    abstract public function offsetUnsetProvider(): array;

    abstract public function countProvider(): array;

    abstract public function createProvider(): array;

    abstract public function errorValueProvider(): array;

    abstract protected function createCollection(array $rawData): AbstractCollection;
}
