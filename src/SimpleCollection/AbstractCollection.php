<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

abstract class AbstractCollection implements \Countable, \IteratorAggregate, \ArrayAccess
{
    private \Closure $typeChecker;

    protected array $items = [];

    public function __construct(\Closure $typeChecker, array $items = [])
    {
        $this->typeChecker = $typeChecker;

        foreach ($items as $k => $v) {
            $this->assertType($v);
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
        $this->assertType($value);

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

    protected function assertType($value): void
    {
        if (!$this->typeChecker->call($this, $value)) {
            throw new \InvalidArgumentException(
                sprintf('Value of type "%s" is not allowed for "%s"', $this->getValueType($value), static::class)
            );
        }
    }

    private function getValueType($value): string
    {
        if (is_object($value)) {
            return get_class($value);
        }

        return gettype($value);
    }
}
