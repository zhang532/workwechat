<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenWork\Work;

use WorkWechat\OpenWork\Application as OpenWork;
use WorkWechat\OpenWork\Work\Auth\AccessToken;
use WorkWechat\Work\Application as Work;

/**
 * Application.
 *
 * @author xiaomin <keacefull@gmail.com>
 */
class Application extends Work
{
    /**
     * Application constructor.
     */
    public function __construct(string $authCorpId, string $permanentCode, OpenWork $component, array $prepends = [])
    {
        parent::__construct($component->getConfig(), $prepends + [
                'access_token' => function ($app) use ($authCorpId, $permanentCode, $component) {
                    return new AccessToken($app, $authCorpId, $permanentCode, $component);
                },
            ]);
    }
}
