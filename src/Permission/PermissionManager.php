<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-05-03 18:15
 */
namespace Notadd\Foundation\Permission;

use Illuminate\Container\Container;
use Illuminate\Support\Collection;

/**
 * Class PermissionManager.
 */
class PermissionManager
{
    /**
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $groups;

    /**
     * PermissionManager constructor.
     *
     * @param \Illuminate\Container\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->groups = new Collection();
        $this->initialize();
    }

    /**
     * @param array  $attributes
     *
     * @return bool
     */
    public function group(array $attributes)
    {
        if (PermissionGroup::validate($attributes)) {
            $this->groups->put($attributes['identification'], PermissionGroup::createFromAttributes($attributes));

            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function groups()
    {
        return $this->groups;
    }

    public function initialize()
    {
        $this->groups->put('global', PermissionGroup::createFromAttributes([
            'description' => '全局权限定义。',
            'identification' => 'global',
            'name' => '全局权限',
        ]));
    }

    /**
     * @param string $group
     * @param array  $attributes
     *
     * @return bool
     */
    public function permission(string $group, array $attributes)
    {
        if ($this->groups->has($group)) {
            return $this->groups->get($group)->permission($attributes);
        } else {
            return false;
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function permissions()
    {
        $permissions = new Collection();
        $this->groups->each(function (PermissionGroup $group) use ($permissions) {
            $permissions->merge($group->permissions());
        });

        return $permissions;
    }
}
