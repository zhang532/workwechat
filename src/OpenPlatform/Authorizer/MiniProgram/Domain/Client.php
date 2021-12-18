<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OpenPlatform\Authorizer\MiniProgram\Domain;

use WorkWechat\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function modify(array $params)
    {
        return $this->httpPostJson('wxa/modify_domain', $params);
    }

    /**
     * 设置小程序业务域名.
     *
     * @param string $action
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setWebviewDomain(array $domains, $action = 'add')
    {
        return $this->httpPostJson('wxa/setwebviewdomain', [
            'action' => $action,
            'webviewdomain' => $domains,
        ]);
    }
}