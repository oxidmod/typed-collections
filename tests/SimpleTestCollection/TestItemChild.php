<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests\SimpleTestCollection;

class TestItemChild extends TestItem implements TestItemInterface
{
    public string $string;

    public function __construct()
    {
        parent::__construct();

        $this->string = random_int(0, 1) ? '' : random_bytes(8);
    }
}
