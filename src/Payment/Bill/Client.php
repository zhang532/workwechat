<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Payment\Bill;

use WorkWechat\Kernel\Http\StreamResponse;
use WorkWechat\Payment\Kernel\BaseClient;

class Client extends BaseClient
{
    /**
     * Download bill history as a table file.
     *
     * @return \WorkWechat\Kernel\Http\StreamResponse|\Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $date, string $type = 'ALL', array $optional = [])
    {
        $params = [
            'appid' => $this->app['config']->app_id,
            'bill_date' => $date,
            'bill_type' => $type,
        ] + $optional;

        $response = $this->requestRaw($this->wrap('pay/downloadbill'), $params);

        if (0 === strpos($response->getBody()->getContents(), '<xml>')) {
            return $this->castResponseToType($response, $this->app['config']->get('response_type'));
        }

        return StreamResponse::buildFromPsrResponse($response);
    }
}
