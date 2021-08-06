<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\TypeChecker;

class ArrayChecker implements TypeCheckerInterface
{
    public function isValidType($value): bool
    {
        return is_array($value);
    }
}
