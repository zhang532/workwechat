<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Payment\Reverse;

use WorkWechat\Payment\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * Reverse order by out trade number.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function byOutTradeNumber(string $outTradeNumber)
    {
        return $this->reverse($outTradeNumber, 'out_trade_no');
    }

    /**
     * Reverse order by transaction_id.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function byTransactionId(string $transactionId)
    {
        return $this->reverse($transactionId, 'transaction_id');
    }

    /**
     * Reverse order.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function reverse(string $number, string $type)
    {
        $params = [
            'appid' => $this->app['config']->app_id,
            $type => $number,
        ];

        return $this->safeRequest($this->wrap('secapi/pay/reverse'), $params);
    }
}
