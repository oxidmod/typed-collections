<?php

declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleTestCollection;

class TestInterfaceImpl implements TestItemInterface
{
    public \DateTime $dateTime;

    public function __construct()
    {
        $this->dateTime = new \DateTime();
    }
}
