<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\TypeChecker;

class BooleanChecker implements TypeCheckerInterface
{
    public function isValidType($value): bool
    {
        return is_bool($value);
    }
}
