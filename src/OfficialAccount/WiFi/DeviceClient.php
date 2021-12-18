<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OfficialAccount\WiFi;

use WorkWechat\Kernel\BaseClient;

/**
 * Class DeviceClient.
 *
 * @author her-cat <i@her-cat.com>
 */
class DeviceClient extends BaseClient
{
    /**
     * Add a password device.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addPasswordDevice(int $shopId, string $ssid, string $password)
    {
        $data = [
            'shop_id' => $shopId,
            'ssid' => $ssid,
            'password' => $password,
        ];

        return $this->httpPostJson('bizwifi/device/add', $data);
    }

    /**
     * Add a portal device.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addPortalDevice(int $shopId, string $ssid, bool $reset = false)
    {
        $data = [
            'shop_id' => $shopId,
            'ssid' => $ssid,
            'reset' => $reset,
        ];

        return $this->httpPostJson('bizwifi/apportal/register', $data);
    }

    /**
     * Delete device by MAC address.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $macAddress)
    {
        return $this->httpPostJson('bizwifi/device/delete', ['bssid' => $macAddress]);
    }

    /**
     * Get a list of devices.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list(int $page = 1, int $size = 10)
    {
        $data = [
            'pageindex' => $page,
            'pagesize' => $size,
        ];

        return $this->httpPostJson('bizwifi/device/list', $data);
    }

    /**
     * Get a list of devices by shop ID.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listByShopId(int $shopId, int $page = 1, int $size = 10)
    {
        $data = [
            'shop_id' => $shopId,
            'pageindex' => $page,
            'pagesize' => $size,
        ];

        return $this->httpPostJson('bizwifi/device/list', $data);
    }
}
