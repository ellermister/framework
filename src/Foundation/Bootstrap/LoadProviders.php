<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-10-21 10:58
 */
namespace Notadd\Foundation\Bootstrap;

use Illuminate\Contracts\Foundation\Application;

/**
 * Class BootProviders.
 */
class LoadProviders
{
    /**
     * @param \Illuminate\Contracts\Foundation\Application $application
     *
     * @return void
     */
    public function bootstrap(Application $application)
    {
        $application->registerConfiguredProviders();
        $application->boot();
    }
}