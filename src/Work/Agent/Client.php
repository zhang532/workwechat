<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Work\Agent;

use WorkWechat\Kernel\BaseClient;

/**
 * This is WeWork Agent Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Get agent.
     *
     * @return mixed
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function get(int $agentId)
    {
        $params = [
            'agentid' => $agentId,
        ];

        return $this->httpGet('cgi-bin/agent/get', $params);
    }

    /**
     * Set agent.
     *
     * @return mixed
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function set(int $agentId, array $attributes)
    {
        return $this->httpPostJson('cgi-bin/agent/set', array_merge(['agentid' => $agentId], $attributes));
    }

    /**
     * Get agent list.
     *
     * @return mixed
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function list()
    {
        return $this->httpGet('cgi-bin/agent/list');
    }
}
