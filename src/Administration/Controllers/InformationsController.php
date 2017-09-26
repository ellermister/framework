<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-09-26 15:06
 */
namespace Notadd\Foundation\Administration\Controllers;

use Notadd\Foundation\Routing\Abstracts\Controller;

/**
 * Class InformationsController.
 */
class InformationsController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        $scripts = collect();
        $stylesheets = collect();

        return $this->response->json([
            'data'    => [
                'navigation'  => $this->module->menus()->structures()->toArray(),
                'pages'       => $this->administration->pages()->toArray(),
                'scripts'     => $scripts->toArray(),
                'stylesheets' => $stylesheets->toArray(),
            ],
            'message' => '获取模块和插件信息成功！',
        ]);
    }
}
