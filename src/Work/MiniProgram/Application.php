<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Work\MiniProgram;

use WorkWechat\MiniProgram\Application as MiniProgram;
use WorkWechat\Work\Auth\AccessToken;
use WorkWechat\Work\MiniProgram\Auth\Client;

/**
 * Class Application.
 *
 * @author Caikeal <caikeal@qq.com>
 *
 * @property \WorkWechat\Work\MiniProgram\Auth\Client $auth
 */
class Application extends MiniProgram
{
    /**
     * Application constructor.
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($config, $prepends + [
            'access_token' => function ($app) {
                return new AccessToken($app);
            },
            'auth' => function ($app) {
                return new Client($app);
            },
        ]);
    }
}
