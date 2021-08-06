<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\TypeChecker;

interface TypeCheckerInterface
{
    public function isValidType($value): bool;
}
