<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenPlatform\Authorizer\MiniProgram;

use WorkWechat\MiniProgram\Application as MiniProgram;
use WorkWechat\OpenPlatform\Authorizer\Aggregate\AggregateServiceProvider;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \WorkWechat\OpenPlatform\Authorizer\MiniProgram\Account\Client $account
 * @property \WorkWechat\OpenPlatform\Authorizer\MiniProgram\Code\Client    $code
 * @property \WorkWechat\OpenPlatform\Authorizer\MiniProgram\Domain\Client  $domain
 * @property \WorkWechat\OpenPlatform\Authorizer\MiniProgram\Setting\Client $setting
 * @property \WorkWechat\OpenPlatform\Authorizer\MiniProgram\Tester\Client  $tester
 */
class Application extends MiniProgram
{
    /**
     * Application constructor.
     */
    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($config, $prepends);

        $providers = [
            AggregateServiceProvider::class,
            Code\ServiceProvider::class,
            Domain\ServiceProvider::class,
            Account\ServiceProvider::class,
            Setting\ServiceProvider::class,
            Tester\ServiceProvider::class,
        ];

        foreach ($providers as $provider) {
            $this->register(new $provider());
        }
    }
}
