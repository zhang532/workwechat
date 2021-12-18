<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\Payment\Merchant;

use WorkWechat\Payment\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * Add sub-merchant.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function addSubMerchant(array $params)
    {
        return $this->manage($params, ['action' => 'add']);
    }

    /**
     * Query sub-merchant by merchant id.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function querySubMerchantByMerchantId(string $id)
    {
        $params = [
            'micro_mch_id' => $id,
        ];

        return $this->manage($params, ['action' => 'query']);
    }

    /**
     * Query sub-merchant by wechat id.
     *
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     */
    public function querySubMerchantByWeChatId(string $id)
    {
        $params = [
            'recipient_wechatid' => $id,
        ];

        return $this->manage($params, ['action' => 'query']);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface|\WorkWechat\Kernel\Support\Collection|array|object|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function manage(array $params, array $query)
    {
        $params = array_merge($params, [
            'appid' => $this->app['config']->app_id,
            'nonce_str' => '',
            'sub_mch_id' => '',
            'sub_appid' => '',
        ]);

        return $this->safeRequest('secapi/mch/submchmanage', $params, 'post', compact('query'));
    }
}
