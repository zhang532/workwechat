<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenWork\MiniProgram;

use WorkWechat\Kernel\BaseClient;
use WorkWechat\Kernel\ServiceContainer;

/**
 * Class Client.
 */
class Client extends BaseClient
{
    /**
     * Client constructor.
     */
    public function __construct(ServiceContainer $app)
    {
        parent::__construct($app, $app['suite_access_token']);
    }

    /**
     * Get session info by code.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function session(string $code)
    {
        $params = [
            'js_code' => $code,
            'grant_type' => 'authorization_code',
        ];

        return $this->httpGet('cgi-bin/service/miniprogram/jscode2session', $params);
    }
}
