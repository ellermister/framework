<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-11-30 14:48
 */

namespace Notadd\Foundation\Configuration\Contract;

/**
 * Interface Loader.
 */
interface Loader
{
    /**
     * @param string $environment
     * @param string $group
     * @param string $namespace
     *
     * @return array
     */
    public function load($environment, $group, $namespace = null);

    /**
     * @param string $group
     * @param string $namespace
     *
     * @return bool
     */
    public function exists($group, $namespace = null);

    /**
     * @param string $namespace
     * @param string $hint
     *
     * @return void
     */
    public function addNamespace($namespace, $hint);

    /**
     * @return array
     */
    public function getNamespaces();

    /**
     * @param string $environment
     * @param string $package
     * @param string $group
     * @param array  $items
     *
     * @return array
     */
    public function cascadePackage($environment, $package, $group, $items);
}