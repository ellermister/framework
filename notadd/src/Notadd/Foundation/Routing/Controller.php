<?php
/**
 * This file is part of Notadd.
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2015, iBenchu.org
 * @datetime 2015-10-18 16:28
 */
namespace Notadd\Foundation\Routing;
use BadMethodCallException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Controller as IlluminateController;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
abstract class Controller extends IlluminateController {
    /**
     * @var Factory
     */
    protected $view;
    /**
     * @param Factory $view
     */
    public function __construct(Factory $view) {
        $this->view = $view;
    }
    /**
     * @param  array $parameters
     * @return mixed
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function missingMethod($parameters = []) {
        throw new NotFoundHttpException('控制器方法未找到。');
    }
    /**
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters) {
        throw new BadMethodCallException("方法[$method]不存在。");
    }
    public function share($key, $value = null) {
        $this->view->share($key, $value);
    }
    public function view($template) {
        if(Str::contains($template, '::')) {
            return $this->view->make($template, $this->data);
        } else {
            return $this->view->make('themes::' . $template);
        }
    }
}