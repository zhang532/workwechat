<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OfficialAccount\Base;

use WorkWechat\Kernel\BaseClient;
use WorkWechat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Clear quota.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function clearQuota()
    {
        $params = [
            'appid' => $this->app['config']['app_id'],
        ];

        return $this->httpPostJson('cgi-bin/clear_quota', $params);
    }

    /**
     * Get wechat callback ip.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function getValidIps()
    {
        return $this->httpGet('cgi-bin/getcallbackip');
    }

    /**
     * Check the callback address network.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkCallbackUrl(string $action = 'all', string $operator = 'DEFAULT')
    {
        if (!in_array($action, ['dns', 'ping', 'all'], true)) {
            throw new InvalidArgumentException('The action must be dns, ping, all.');
        }

        $operator = strtoupper($operator);

        if (!in_array($operator, ['CHINANET', 'UNICOM', 'CAP', 'DEFAULT'], true)) {
            throw new InvalidArgumentException('The operator must be CHINANET, UNICOM, CAP, DEFAULT.');
        }

        $params = [
            'action' => $action,
            'check_operator' => $operator,
        ];

        return $this->httpPostJson('cgi-bin/callback/check', $params);
    }
}
