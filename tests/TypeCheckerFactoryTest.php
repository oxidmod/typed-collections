<?php
declare(strict_types=1);

namespace Oxidmod\TypedCollections\Tests;

use Oxidmod\TypedCollections\TypeCheckerFactory;
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
            'array checker + array' => [TypeCheckerFactory::arrayChecker(), [], true],
            'array checker + ArrayAccess' => [TypeCheckerFactory::arrayChecker(), new \ArrayObject(), false],
            'array checker + boolean' => [TypeCheckerFactory::arrayChecker(), true, false],
            'array checker + float' => [TypeCheckerFactory::arrayChecker(), 1.0, false],
            'array checker + int' => [TypeCheckerFactory::arrayChecker(), 1, false],
            'array checker + object' => [TypeCheckerFactory::arrayChecker(), new \stdClass(), false],
            'array checker + string' => [TypeCheckerFactory::arrayChecker(), 'string', false],
            'array checker + null' => [TypeCheckerFactory::arrayChecker(), null, false],
            'array checker + resource' => [TypeCheckerFactory::arrayChecker(), fopen('php://memory', 'r'), false],
            'boolean checker + array' => [TypeCheckerFactory::booleanChecker(), [], false],
            'boolean checker + boolean' => [TypeCheckerFactory::booleanChecker(), false, true],
            'boolean checker + float' => [TypeCheckerFactory::booleanChecker(), 1.0, false],
            'boolean checker + int' => [TypeCheckerFactory::booleanChecker(), 1, false],
            'boolean checker + object' => [TypeCheckerFactory::booleanChecker(), new \stdClass(), false],
            'boolean checker + string' => [TypeCheckerFactory::booleanChecker(), 'string', false],
            'boolean checker + null' => [TypeCheckerFactory::booleanChecker(), null, false],
            'boolean checker + resource' => [TypeCheckerFactory::booleanChecker(), fopen('php://memory', 'r'), false],
            'float checker + array' => [TypeCheckerFactory::floatChecker(), [], false],
            'float checker + boolean' => [TypeCheckerFactory::floatChecker(), false, false],
            'float checker + float' => [TypeCheckerFactory::floatChecker(), 1.0, true],
            'float checker + int' => [TypeCheckerFactory::floatChecker(), 1, false],
            'float checker + object' => [TypeCheckerFactory::floatChecker(), new \stdClass(), false],
            'float checker + string' => [TypeCheckerFactory::floatChecker(), 'string', false],
            'float checker + null' => [TypeCheckerFactory::floatChecker(), null, false],
            'float checker + resource' => [TypeCheckerFactory::floatChecker(), fopen('php://memory', 'r'), false],
            'int checker + array' => [TypeCheckerFactory::integerChecker(), [], false],
            'int checker + boolean' => [TypeCheckerFactory::integerChecker(), false, false],
            'int checker + float' => [TypeCheckerFactory::integerChecker(), 1.0, false],
            'int checker + int' => [TypeCheckerFactory::integerChecker(), 1, true],
            'int checker + object' => [TypeCheckerFactory::integerChecker(), new \stdClass(), false],
            'int checker + string' => [TypeCheckerFactory::integerChecker(), 'string', false],
            'int checker + null' => [TypeCheckerFactory::integerChecker(), null, false],
            'int checker + resource' => [TypeCheckerFactory::integerChecker(), fopen('php://memory', 'r'), false],
            'object checker + array' => [TypeCheckerFactory::objectChecker(), [], false],
            'object checker + boolean' => [TypeCheckerFactory::objectChecker(), false, false],
            'object checker + float' => [TypeCheckerFactory::objectChecker(), 1.0, false],
            'object checker + int' => [TypeCheckerFactory::objectChecker(), 1, false],
            'object checker + object' => [TypeCheckerFactory::objectChecker(), new \stdClass(), true],
            'object checker + string' => [TypeCheckerFactory::objectChecker(), 'string', false],
            'object checker + null' => [TypeCheckerFactory::objectChecker(), null, false],
            'object checker + resource' => [TypeCheckerFactory::objectChecker(), fopen('php://memory', 'r'), false],
            'string checker + array' => [TypeCheckerFactory::stringChecker(), [], false],
            'string checker + boolean' => [TypeCheckerFactory::stringChecker(), false, false],
            'string checker + float' => [TypeCheckerFactory::stringChecker(), 1.0, false],
            'string checker + int' => [TypeCheckerFactory::stringChecker(), 1, false],
            'string checker + object' => [TypeCheckerFactory::stringChecker(), new \stdClass(), false],
            'string checker + string' => [TypeCheckerFactory::stringChecker(), 'string', true],
            'string checker + __toString' => [
                TypeCheckerFactory::stringChecker(),
                new class {
                    public function __toString() {
                        return '' ;
                    }
                },
                false
            ],
            'string checker + null' => [TypeCheckerFactory::stringChecker(), null, false],
            'string checker + resource' => [TypeCheckerFactory::stringChecker(), fopen('php://memory', 'r'), false],
            'type checker + array' => [TypeCheckerFactory::typeChecker(\stdClass::class), [], false],
            'type checker + boolean' => [TypeCheckerFactory::typeChecker(\stdClass::class), false, false],
            'type checker + float' => [TypeCheckerFactory::typeChecker(\stdClass::class), 1.0, false],
            'type checker + int' => [TypeCheckerFactory::typeChecker(\stdClass::class), 1, false],
            'type checker + object' => [TypeCheckerFactory::typeChecker(\stdClass::class), new \stdClass(), true],
            'type checker + interface' => [TypeCheckerFactory::typeChecker(\ArrayAccess::class), new \ArrayObject(), true],
            'type checker + string' => [TypeCheckerFactory::typeChecker(\stdClass::class), 'string', false],
            'type checker + null' => [TypeCheckerFactory::typeChecker(\stdClass::class), null, false],
            'type checker + resource' => [TypeCheckerFactory::typeChecker(\stdClass::class), fopen('php://memory', 'r'), false],
        ];
    }
}
