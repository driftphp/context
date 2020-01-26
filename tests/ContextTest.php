<?php

/*
 * This file is part of the DriftPHP Project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

declare(strict_types=1);

namespace Drift\Tests;

use Drift\Context;
use PHPUnit\Framework\TestCase;

/**
 * Class ContextTest.
 */
class ContextTest extends TestCase
{
    /**
     * Test create.
     */
    public function testCreate()
    {
        $this->assertInstanceOf(Context::class, Context::createEmpty());
        $this->assertInstanceOf(Context::class, Context::createWithValue(self::class, 'key', 'value'));
    }

    /**
     * Test context setter.
     */
    public function testContextSetter()
    {
        $context = Context::createWithValue(self::class, 'key', 'value');
        $context->withValue(self::class, 'key', 'value2');
        $context->withValue('Another\Namespace', 'key', 'value3');
        $context->withValue(self::class, 'anotherkey', 'value4');
        $this->assertEquals('value2', $context->getValue(self::class, 'key'));
        $this->assertEquals('value3', $context->getValue('Another\Namespace', 'key'));
        $this->assertEquals('value4', $context->getValue(self::class, 'anotherkey'));
    }

    /**
     * Test key not found.
     */
    public function testKeyNotFound()
    {
        $context = Context::createEmpty();
        $this->assertNull($context->getValue(self::class, 'key'));
        $context->withValue(self::class, 'anotherkey', 'value');
        $this->assertNull($context->getValue(self::class, 'key'));
    }
}
