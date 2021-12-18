<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Work\OAuth;

use WorkWechat\Work\Application;
use Overtrue\Socialite\AccessTokenInterface;

/**
 * Class AccessTokenDelegate.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class AccessTokenDelegate implements AccessTokenInterface
{
    /**
     * @var \WorkWechat\Work\Application
     */
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Return the access token string.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->app['access_token']->getToken()['access_token'];
    }
}
