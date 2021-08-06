<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\TypeChecker;

class CustomTypeChecker implements TypeCheckerInterface
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function isValidType($value): bool
    {
        return $value instanceof $this->type;
    }
}
