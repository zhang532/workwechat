<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\MicroMerchant\Material;

use WorkWechat\MicroMerchant\Kernel\BaseClient;

/**
 * Class Client.
 *
 * @author   liuml  <liumenglei0211@163.com>
 * @DateTime 2019-05-30  14:19
 */
class Client extends BaseClient
{
    /**
     * update settlement card.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\MicroMerchant\Kernel\Exceptions\EncryptException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setSettlementCard(array $params)
    {
        $params['sub_mch_id'] = $params['sub_mch_id'] ?? $this->app['config']->sub_mch_id;
        $params = $this->processParams(array_merge($params, [
            'version' => '1.0',
            'cert_sn' => '',
            'sign_type' => 'HMAC-SHA256',
            'nonce_str' => uniqid('micro'),
        ]));

        return $this->safeRequest('applyment/micro/modifyarchives', $params);
    }

    /**
     * update contact info.
     *
     * @return array|\WorkWechat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\MicroMerchant\Kernel\Exceptions\EncryptException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateContact(array $params)
    {
        $params['sub_mch_id'] = $params['sub_mch_id'] ?? $this->app['config']->sub_mch_id;
        $params = $this->processParams(array_merge($params, [
            'version' => '1.0',
            'cert_sn' => '',
            'sign_type' => 'HMAC-SHA256',
            'nonce_str' => uniqid('micro'),
        ]));

        return $this->safeRequest('applyment/micro/modifycontactinfo', $params);
    }
}
