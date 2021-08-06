<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\TypeChecker;

class ObjectChecker implements TypeCheckerInterface
{
    public function isValidType($value): bool
    {
        return is_object($value);
    }
}
