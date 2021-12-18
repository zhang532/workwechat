<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenPlatform\Authorizer\OfficialAccount;

use WorkWechat\OfficialAccount\Application as OfficialAccount;
use WorkWechat\OpenPlatform\Authorizer\Aggregate\AggregateServiceProvider;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \WorkWechat\OpenPlatform\Authorizer\OfficialAccount\Account\Client     $account
 * @property \WorkWechat\OpenPlatform\Authorizer\OfficialAccount\MiniProgram\Client $mini_program
 */
class Application extends OfficialAccount
{
    /**
     * Application constructor.
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($config, $prepends);

        $providers = [
            AggregateServiceProvider::class,
            MiniProgram\ServiceProvider::class,
        ];

        foreach ($providers as $provider) {
            $this->register(new $provider());
        }
    }
}
