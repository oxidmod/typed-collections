<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\TypeChecker;

class StringChecker implements TypeCheckerInterface
{
    public function isValidType($value): bool
    {
        return is_string($value);
    }
}
