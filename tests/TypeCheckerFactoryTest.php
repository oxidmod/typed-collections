<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests;

use Oxidmod\TypedCollections\TypeCheckerFactory as Factory;
use PHPUnit\Framework\TestCase;

class TypeCheckerFactoryTest extends TestCase
{
    /**
     * @param \Closure $checker
     * @param $value
     * @param bool $expected
     *
     * @dataProvider typeCheckerProvider
     */
    public function testTypeChecker(\Closure $checker, $value, bool $expected): void
    {
        $this->assertSame($expected, $checker($value));
    }

    public function typeCheckerProvider(): array
    {
        return [
            'array checker + array' => [Factory::arrayChecker(), [], true],
            'array checker + ArrayAccess' => [Factory::arrayChecker(), new \ArrayObject(), false],
            'array checker + boolean' => [Factory::arrayChecker(), true, false],
            'array checker + float' => [Factory::arrayChecker(), 1.0, false],
            'array checker + int' => [Factory::arrayChecker(), 1, false],
            'array checker + object' => [Factory::arrayChecker(), new \stdClass(), false],
            'array checker + string' => [Factory::arrayChecker(), 'string', false],
            'array checker + null' => [Factory::arrayChecker(), null, false],
            'array checker + resource' => [Factory::arrayChecker(), fopen('php://memory', 'r'), false],
            'boolean checker + array' => [Factory::booleanChecker(), [], false],
            'boolean checker + boolean' => [Factory::booleanChecker(), false, true],
            'boolean checker + float' => [Factory::booleanChecker(), 1.0, false],
            'boolean checker + int' => [Factory::booleanChecker(), 1, false],
            'boolean checker + object' => [Factory::booleanChecker(), new \stdClass(), false],
            'boolean checker + string' => [Factory::booleanChecker(), 'string', false],
            'boolean checker + null' => [Factory::booleanChecker(), null, false],
            'boolean checker + resource' => [Factory::booleanChecker(), fopen('php://memory', 'r'), false],
            'float checker + array' => [Factory::floatChecker(), [], false],
            'float checker + boolean' => [Factory::floatChecker(), false, false],
            'float checker + float' => [Factory::floatChecker(), 1.0, true],
            'float checker + int' => [Factory::floatChecker(), 1, false],
            'float checker + object' => [Factory::floatChecker(), new \stdClass(), false],
            'float checker + string' => [Factory::floatChecker(), 'string', false],
            'float checker + null' => [Factory::floatChecker(), null, false],
            'float checker + resource' => [Factory::floatChecker(), fopen('php://memory', 'r'), false],
            'int checker + array' => [Factory::integerChecker(), [], false],
            'int checker + boolean' => [Factory::integerChecker(), false, false],
            'int checker + float' => [Factory::integerChecker(), 1.0, false],
            'int checker + int' => [Factory::integerChecker(), 1, true],
            'int checker + object' => [Factory::integerChecker(), new \stdClass(), false],
            'int checker + string' => [Factory::integerChecker(), 'string', false],
            'int checker + null' => [Factory::integerChecker(), null, false],
            'int checker + resource' => [Factory::integerChecker(), fopen('php://memory', 'r'), false],
            'object checker + array' => [Factory::objectChecker(), [], false],
            'object checker + boolean' => [Factory::objectChecker(), false, false],
            'object checker + float' => [Factory::objectChecker(), 1.0, false],
            'object checker + int' => [Factory::objectChecker(), 1, false],
            'object checker + object' => [Factory::objectChecker(), new \stdClass(), true],
            'object checker + string' => [Factory::objectChecker(), 'string', false],
            'object checker + null' => [Factory::objectChecker(), null, false],
            'object checker + resource' => [Factory::objectChecker(), fopen('php://memory', 'r'), false],
            'string checker + array' => [Factory::stringChecker(), [], false],
            'string checker + boolean' => [Factory::stringChecker(), false, false],
            'string checker + float' => [Factory::stringChecker(), 1.0, false],
            'string checker + int' => [Factory::stringChecker(), 1, false],
            'string checker + object' => [Factory::stringChecker(), new \stdClass(), false],
            'string checker + string' => [Factory::stringChecker(), 'string', true],
            'string checker + __toString' => [
                Factory::stringChecker(),
                new class {
                    public function __toString()
                    {
                        return '' ;
                    }
                },
                false
            ],
            'string checker + null' => [Factory::stringChecker(), null, false],
            'string checker + resource' => [Factory::stringChecker(), fopen('php://memory', 'r'), false],
            'type checker + array' => [Factory::typeChecker(\stdClass::class), [], false],
            'type checker + boolean' => [Factory::typeChecker(\stdClass::class), false, false],
            'type checker + float' => [Factory::typeChecker(\stdClass::class), 1.0, false],
            'type checker + int' => [Factory::typeChecker(\stdClass::class), 1, false],
            'type checker + object' => [Factory::typeChecker(\stdClass::class), new \stdClass(), true],
            'type checker + interface' => [Factory::typeChecker(\ArrayAccess::class), new \ArrayObject(), true],
            'type checker + string' => [Factory::typeChecker(\stdClass::class), 'string', false],
            'type checker + null' => [Factory::typeChecker(\stdClass::class), null, false],
            'type checker + resource' => [Factory::typeChecker(\stdClass::class), fopen('php://memory', 'r'), false],
        ];
    }
}
