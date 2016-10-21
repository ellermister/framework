<?php
/**
 * This file is part of Notadd.
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-10-21 11:01
 */
namespace Notadd\Foundation\Bootstrap;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\Console\Input\ArgvInput;
/**
 * Class DetectEnvironment
 * @package Notadd\Foundation\Bootstrap
 */
class DetectEnvironment {
    /**
     * @param \Illuminate\Contracts\Foundation\Application|\Notadd\Foundation\Application $app
     * @return void
     */
    public function bootstrap(Application $app) {
        if(!$app->configurationIsCached()) {
            $this->checkForSpecificEnvironmentFile($app);
            try {
                (new Dotenv($app->environmentPath(), $app->environmentFile()))->load();
            } catch(InvalidPathException $e) {
            }
        }
    }
    /**
     * @param \Illuminate\Contracts\Foundation\Application|\Notadd\Foundation\Application $app
     * @return void
     */
    protected function checkForSpecificEnvironmentFile($app) {
        if(php_sapi_name() == 'cli') {
            $input = new ArgvInput;
            if($input->hasParameterOption('--env')) {
                $file = $app->environmentFile() . '.' . $input->getParameterOption('--env');
                $this->loadEnvironmentFile($app, $file);
            }
        }
        if(!env('APP_ENV')) {
            return;
        }
        if(empty($file)) {
            $file = $app->environmentFile() . '.' . env('APP_ENV');
            $this->loadEnvironmentFile($app, $file);
        }
    }
    /**
     * @param \Illuminate\Contracts\Foundation\Application|\Notadd\Foundation\Application $app
     * @param string $file
     * @return void
     */
    protected function loadEnvironmentFile($app, $file) {
        if(file_exists($app->environmentPath() . '/' . $file)) {
            $app->loadEnvironmentFrom($file);
        }
    }
}