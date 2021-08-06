<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\SimpleCollection;

use Oxidmod\TypedCollections\TypeCheckerFactory;

abstract class AbstractCustomTypeCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(
            TypeCheckerFactory::customTypeChecker(static::getType()),
            $items
        );
    }

    abstract protected static function getType(): string;
}
