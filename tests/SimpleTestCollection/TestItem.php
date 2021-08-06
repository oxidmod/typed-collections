<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleTestCollection;

class TestItem
{
    public int $int;

    public \DateTime $dateTime;

    public function __construct()
    {
        $this->int = random_int(PHP_INT_MIN, PHP_INT_MAX);
        $this->dateTime = new \DateTime();
    }
}
