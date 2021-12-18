<?php

/*
 * This file is part of the workwechat/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WorkWechat\OfficialAccount\Card;

use WorkWechat\BasicService\Jssdk\Client as Jssdk;
use WorkWechat\Kernel\Support\Arr;
use function WorkWechat\Kernel\Support\str_random;

/**
 * Class Jssdk.
 *
 * @author overtrue <i@overtrue.me>
 */
class JssdkClient extends Jssdk
{
    /**
     * @throws \WorkWechat\Kernel\Exceptions\InvalidArgumentException
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getTicket(bool $refresh = false, string $type = 'wx_card'): array
    {
        return parent::getTicket($refresh, $type);
    }

    /**
     * 微信卡券：JSAPI 卡券发放.
     *
     * @return string
     */
    public function assign(array $cards)
    {
        return json_encode(array_map(function ($card) {
            return $this->attachExtension($card['card_id'], $card);
        }, $cards));
    }

    /**
     * 生成 js添加到卡包 需要的 card_list 项.
     *
     * @param string $cardId
     *
     * @return array
     *
     * @throws \WorkWechat\Kernel\Exceptions\InvalidConfigException
     * @throws \WorkWechat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function attachExtension($cardId, array $extension = [])
    {
        $timestamp = time();
        $nonce = str_random(6);
        $ticket = $this->getTicket()['ticket'];

        $ext = array_merge(['timestamp' => $timestamp, 'nonce_str' => $nonce], Arr::only(
            $extension,
            ['code', 'openid', 'outer_id', 'balance', 'fixed_begintimestamp', 'outer_str']
        ));

        $ext['signature'] = $this->dictionaryOrderSignature($ticket, $timestamp, $cardId, $ext['code'] ?? '', $ext['openid'] ?? '', $nonce);

        return [
            'cardId' => $cardId,
            'cardExt' => json_encode($ext),
        ];
    }
}
