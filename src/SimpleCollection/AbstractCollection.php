<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

abstract class AbstractCollection implements \Countable, \IteratorAggregate, \ArrayAccess
{
    protected static \Closure $typeChecker;

    protected array $items = [];

    public function __construct(array $items = [])
    {
        $typeChecker = static::getTypeChecker();
        foreach ($items as $k => $v) {
            $this->assertType($v, $typeChecker);
            $this->items[$k] = $v;
        }
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }

    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetSet($offset, $value): void
    {
        $this->assertType($value, static::getTypeChecker());

        null === $offset ? $this->items[] = $value : $this->items[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        if (array_key_exists($offset, $this->items)) {
            unset($this->items[$offset]);
        }
    }

    public function count(): int
    {
        return count($this->items);
    }

    protected function assertType($value, \Closure $checker): void
    {
        if (!$checker($value)) {
            throw new \InvalidArgumentException(
                sprintf('Value "%s" is not allowed for "%s"', var_export($value, true), static::class)
            );
        }
    }

    protected static function getTypeChecker(): \Closure
    {
        if (!isset(static::$typeChecker)) {
            static::$typeChecker = static::createTypeChecker();
        }

        return static::$typeChecker;
    }

    abstract protected static function createTypeChecker(): \Closure;
}
