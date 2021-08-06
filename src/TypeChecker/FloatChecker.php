<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\TypeChecker;

class FloatChecker implements TypeCheckerInterface
{
    public function isValidType($value): bool
    {
        return is_float($value);
    }
}
