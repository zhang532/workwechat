<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Payment\Sandbox;

use WorkWechat\Kernel\Traits\InteractsWithCache;
use WorkWechat\Payment\Kernel\BaseClient;
use WorkWechat\Payment\Kernel\Exceptions\SandboxException;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    use InteractsWithCache;

    /**
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\Payment\Kernel\Exceptions\SandboxException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getKey(): string
    {
        if ($cache = $this->getCache()->get($this->getCacheKey())) {
            return $cache;
        }

        $response = $this->requestArray('sandboxnew/pay/getsignkey');

        if ('SUCCESS' === $response['return_code']) {
            $this->getCache()->set($this->getCacheKey(), $key = $response['sandbox_signkey'], 24 * 3600);

            return $key;
        }

        throw new SandboxException($response['retmsg'] ?? $response['return_msg']);
    }

    protected function getCacheKey(): string
    {
        return 'WorkWechat.payment.sandbox.'.md5($this->app['config']->app_id.$this->app['config']['mch_id']);
    }
}
