<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\MiniProgram\Express;

use WorkWechat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author kehuanhuan <1152018701@qq.com>
 */
class Client extends BaseClient
{
    /**
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function listProviders()
    {
        return $this->httpGet('cgi-bin/express/business/delivery/getall');
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createWaybill(array $params = [])
    {
        return $this->httpPostJson('cgi-bin/express/business/order/add', $params);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteWaybill(array $params = [])
    {
        return $this->httpPostJson('cgi-bin/express/business/order/cancel', $params);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWaybill(array $params = [])
    {
        return $this->httpPostJson('cgi-bin/express/business/order/get', $params);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWaybillTrack(array $params = [])
    {
        return $this->httpPostJson('cgi-bin/express/business/path/get', $params);
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBalance(string $deliveryId, string $bizId)
    {
        return $this->httpPostJson('cgi-bin/express/business/quota/get', [
            'delivery_id' => $deliveryId,
            'biz_id' => $bizId,
        ]);
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPrinter()
    {
        return $this->httpPostJson('cgi-bin/express/business/printer/getall');
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function bindPrinter(string $openid)
    {
        return $this->httpPostJson('cgi-bin/express/business/printer/update', [
            'update_type' => 'bind',
            'openid' => $openid,
        ]);
    }

    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function unbindPrinter(string $openid)
    {
        return $this->httpPostJson('cgi-bin/express/business/printer/update', [
            'update_type' => 'unbind',
            'openid' => $openid,
        ]);
    }
}