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

namespace Drift;

/**
 * Class Context.
 */
final class Context
{
    /**
     * @var array
     */
    private $values = [];

    /**
     * Context constructor.
     */
    private function __construct()
    {
    }

    /**
     * Create.
     */
    public static function createEmpty(): self
    {
        return new self();
    }

    /**
     * With value.
     *
     * @param string $namespace
     * @param string $key
     * @param $value
     *
     * @return self
     */
    public function withValue(
        string $namespace,
        string $key,
        $value
    ): self {
        $newContext = new self();
        $newContext->values = $this->values;

        if (!isset($newContext->values[$namespace])) {
            $newContext->values[$namespace] = [];
        }

        $newContext->values[$namespace][$key] = $value;

        return $newContext;
    }

    /**
     * Get value.
     *
     * @param string $namespace
     * @param string $key
     *
     * @return mixed
     */
    public function getValue(
        string $namespace,
        string $key
    ) {
        return isset($this->values[$namespace])
            ? $this->values[$namespace][$key] ?? null
            : null;
    }
}
